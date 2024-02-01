<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\EmailLogsController;
use App\Models\Subscriber;
use App\Models\JobCategory;
use App\Models\EmailLog;
use Mail;
use App\Mail\JobAlert;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LogCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Job Alerts to Subscribed users once a week on Tuesday';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return 0;
        \Log::info("Job alert Cron runs!");

        // ============================== POSTMARK INTEGRATION ==================================//
        // DB::table('subscribers')->where('id', '>', 1788)->orderBy('id')->chunk(250, function (Collection $subscribers) {
        DB::table('subscribers')->orderBy('id')->chunk(250, function (Collection $subscribers) {
            $datas = [];
            $logdatas = [];
            $alertLog = [];
            foreach ($subscribers as $value) {
                if ($value->unsubscription_date == NULL) {
                    
                
                    $cats = explode(',', $value->opted_for);
                    // $cats = explode(',', "8,10");
                    foreach ($cats as $cat) {
                        $label = (new EmailLogsController)->getsubCat($cat);
                        $html = (new EmailLogsController)->callApi($label,$value->id,$cat);

                        // $details['label'] = $label;
                        $details['label'] = $label['title'];
                        $details['mailCont'] = $html;
                        $details['mailfor'] = $value->email;
                        
                        
                        $datas[] = array(
                            "From" => env('MAIL_USERNAME', 'jobalert@vanderhouwen.com'),
                            "To" => $details['mailfor'],
                            "Subject" => $details['label'],
                            "Tag" => "Weekly Job Alert",
                            "HtmlBody" => $details['mailCont'],
                            "MessageStream" => "broadcast"
                        );

                        $logdatas[] = array(
                            "subscriber_id" => $value->id,
                            "email_content" => "",
                            "sent_for" => $cat,
                            "is_active" => 1
                        );
                        
                        $alertLog[]=array("Alert Mail Queued to: ".$details['mailfor']." for: ".$details['label']);

                    }
                    
                }
            }

            \Log::channel('custom')->info($alertLog);
            DB::table('email_logs')->insert($logdatas);
            // ======================= PHP Curl ======================= //
            
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.postmarkapp.com/email/batch',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>json_encode($datas),
            CURLOPT_HTTPHEADER => array(
                'X-Postmark-Server-Token: 1c48969e-40ae-43c9-a2e4-60c1ab00ec20',
                'Content-Type: application/json'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
            
            // exit;
            // ======================= END PHP Curl ======================= //


        });
        // ============================== END POSTMARK INTEGRATION ==================================//
        
    }
}
