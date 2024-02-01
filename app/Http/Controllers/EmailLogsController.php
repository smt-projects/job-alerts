<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Http;
use App\Models\Subscriber;
use App\Models\JobCategory;
use App\Models\EmailLog;
use Carbon\Carbon;use Hash;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;


use Mail;
 
use App\Mail\JobAlert;

use Auth;

class EmailLogsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['sendJobAlert', 'sendTestJobAlert', 'getdeliveries', 'getemaillogs', 'getEmaildata', 'getNotdelivered', 'getversion', 'getpostmarkdeliveries', 'getpostmarkNotdelivered']]);
    }

	public function index(){
	    
	    EmailLog::where('is_active', 1)->update(['is_active' => 0]);
        $emaillogs = 'Please Wait!';
        
        return view('emaillogs.index',compact('emaillogs'));
	}

    public function getemaillogs(Request $request){

        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page
        
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = EmailLog::select('count(*) as allcount')->count();
        $totalRecordswithFilter = EmailLog::leftJoin('subscribers', 'email_logs.subscriber_id', '=', 'subscribers.id')
            ->leftJoin('job_categories', 'email_logs.sent_for', '=', 'job_categories.id')
            ->select('count(*) as allcount')
            ->orderby('email_logs.created_at','DESC')->count();


        if ($searchValue != "") {
          $totalRecordswithFilter = EmailLog::leftJoin('subscribers', 'email_logs.subscriber_id', '=', 'subscribers.id')
              ->leftJoin('job_categories', 'email_logs.sent_for', '=', 'job_categories.id')
              ->select('count(*) as allcount')
              ->where('subscribers.email', 'like', '%' .$searchValue . '%')
              ->orWhere('job_categories.title', 'like', '%' .$searchValue . '%')
              ->orWhere('email_logs.created_at', 'like', '%' .$searchValue . '%')
              // ->skip($start)
              // ->take($rowperpage)
              ->orderby('email_logs.created_at','DESC')->count();
        }


        // Fetch records
        $records = EmailLog::leftJoin('subscribers', 'email_logs.subscriber_id', '=', 'subscribers.id')
            ->leftJoin('job_categories', 'email_logs.sent_for', '=', 'job_categories.id')
            ->select('*','email_logs.id AS email_id','job_categories.id AS cat_id','email_logs.created_at AS email_created_at')
            ->orderby('email_logs.created_at','DESC')
            ->skip($start)
            ->take($rowperpage)->get();

        if ($searchValue !="") {
          // Fetch records
          $records = EmailLog::leftJoin('subscribers', 'email_logs.subscriber_id', '=', 'subscribers.id')
              ->leftJoin('job_categories', 'email_logs.sent_for', '=', 'job_categories.id')
              ->where('subscribers.email', 'like', '%' .$searchValue . '%')
              ->orWhere('job_categories.title', 'like', '%' .$searchValue . '%')
              ->orWhere('email_logs.created_at', 'like', '%' .$searchValue . '%')
              ->select('*','email_logs.id AS email_id','job_categories.id AS cat_id','email_logs.created_at AS email_created_at')
              ->skip($start)
              ->take($rowperpage)
              ->orderby('email_logs.created_at','DESC')->get();
        }

        $data_arr = array();

        // $i = 1;
        foreach($records as $record){
          $start++;
           $title = $record->title;
           $fname = $record->fname;
           $lname = $record->lname;
           $username = $record->fname." ".$record->lname;
           $mCont = substr($record->email_content, 0, strlen($record->email_content) - 0);
           $email_id = $record->email_id;
           $email_content = '<button type="button" class="btn btn-primary modal_btn" data-toggle="modal" data-target="#emailModalLong" data-cont="'.$email_id.'" data-title="Sent to '.$username.' for '.$title.'"> Show </button>';
           
           $email = $record->email;
           $email_created_at = $record->email_created_at;

           $data_arr[] = array(
               "id" => $start,
               "username" => $username,
               "email" => $email,
               "email_content" => $email_content,
               "title" => $title,
               "email_created_at" => $email_created_at
           );
           
        }

        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordswithFilter,
           "aaData" => $data_arr
        );

        return response()->json($response); 
     }

    public function getEmaildata(Request $request)
    {
      $bodyContent = EmailLog::selectRaw('email_content')->where('id', $request->get('id'))->get()->toArray();
      
      return $bodyContent;
        
    }


    public function callApi($label,$subid,$catid){
    	if ($label == '') {
    		$label = 'Systems and Database Operations';
    	}
    	 // URL
        $apiURL = 'https://vanderhouwen.com/wp-json/vanderhouwen/v1/job_searches';

        // POST Data
        $postInput = [
            'category_name' => $label['title'],
            'category_list' => $label['categories'],
            'subid' => $subid,
            'catid' => $catid
        ];
  
        // Headers
        $headers = [
            //...
        ];
  
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $apiURL, ['form_params' => $postInput, 'headers' => $headers]);
     
        $responseBody = json_decode($response->getBody(), true);
    
        return substr(stripcslashes($responseBody.'\r\n'), 1); // body response
        // return $responseBody;

    }

    public function sendJobAlert()
    {
        $offset = 0;
        $icnt = 0;
        $limit = 2;
        for($offset; $offset < 10000; $offset = $offset+2){
      

            $subscribers = Subscriber::whereNull('unsubscription_date')->offset($offset)->limit($limit)->get()->toArray();
           
            if(count($subscribers) < 1) break;
            // $icnt = $offset + 2;

            $datas = [];
            foreach ($subscribers as $value) {
                
                if ($value['unsubscription_date'] == NULL) {
                    
                
                    $cats = explode(',', $value['opted_for']);
                    // $cats = explode(',', "8,10");
                    foreach ($cats as $cat) {
                        // $label = $this->getCat($cat);
                        $label = $this->getsubCat($cat);
                        $html = $this->callApi($label,$value['id'],$cat);

                        // $details['label'] = $label;
                        $details['label'] = $label['title'];
                        $details['mailCont'] = $html;
                        $details['mailfor'] = $value['email'];
                        
                        $datas[] = array(
                            "From" => "wordpress@vanderhouwen.com",
                            "To" => $details['mailfor'],
                            "Subject" => $details['label'],
                            "Tag" => "Weekly Job Alert",
                            // "TextBody" => "Hello dear Postmark user.",
                            // "HtmlBody" => $details['mailCont'],
                            "HtmlBody" => '<html><body><strong>Hello</strong> dear Postmark user.</body></html>',
                            "MessageStream" => "broadcast"
                        );

                    }
                    
                }
                
            }

            echo "<pre>"; print_r($datas);
        
        }
        
    }


    public function sendTestJobAlert()
    {
        DB::table('subscribers')->orderBy('id')->chunk(100, function (Collection $subscribers) {
            $datas = [];
            $logdatas = [];
            foreach ($subscribers as $value) {
                if ($value->unsubscription_date == NULL) {
                    
                
                    $cats = explode(',', $value->opted_for);
                    // $cats = explode(',', "8,10");
                    foreach ($cats as $cat) {
                        // $label = $this->getCat($cat);
                        $label = $this->getsubCat($cat);
                        $html = $this->callApi($label,$value->id,$cat);

                        // $details['label'] = $label;
                        $details['label'] = $label['title'];
                        $details['mailCont'] = $html;
                        $details['mailfor'] = $value->email;
                        
                        
                        $datas[] = array(
                            "From" => env('MAIL_USERNAME'),
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
            
                        \Log::channel('custom')->info("Alert Mail Queued to: ".$details['mailfor']." for: ".$details['label']);

                    }
                    
                }
            }

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
                'X-Postmark-Server-Token: 30b33863-4a9c-4cc6-b51d-4b434067f659',
                'Content-Type: application/json'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
            
            // exit;
            // ======================= END PHP Curl ======================= //

        });
        
    }

    public function getdeliveries(Request $request)
    {
        $eventsRaw = request()->__get('event-data');
        // $events_dec= json_decode($events);
        $recipient = $eventsRaw["message"]["headers"]["to"];
        $subject = $eventsRaw["message"]["headers"]["subject"];
        $message_id = $eventsRaw["message"]["headers"]["message-id"];
        

        if (($subject == 'Software Development') || ($subject == 'Engineering') || ($subject == 'Systems and Database Operations') || ($subject == 'Accounting and Finance') || ($subject == 'Business Analysis and Project Management') || ($subject == 'Business Services')) {
            \Log::channel('customalert')->alert("Alert Mail Delivered to: ".$recipient.", subject: ".$subject.", message-id: ".$message_id);
        }

        return response()->json(['status' => 200]);

    }

    public function getNotdelivered(Request $request)
    {
        $eventsRaw = request()->__get('event-data');
        
        $recipient = $eventsRaw["message"]["headers"]["to"];
        $subject = $eventsRaw["message"]["headers"]["subject"];
        $message_id = $eventsRaw["message"]["headers"]["message-id"];
        $events_dec= json_encode($eventsRaw);
        

        if (($subject == 'Software Development') || ($subject == 'Engineering') || ($subject == 'Systems and Database Operations') || ($subject == 'Accounting and Finance') || ($subject == 'Business Analysis and Project Management') || ($subject == 'Business Services')) {
            
          \Log::channel('customunsent')->alert($eventsRaw);
        }

        return response()->json(['status' => 200]);

    }


    public function getversion(){
        echo "Hello";
        return response()->json(['status' => 200]);
    }
    public function getpostmarkdeliveries(Request $request)
    {
        $events = json_decode(file_get_contents("php://input"));
        $eventsRaw = (array) $events;
        // echo "<pre>";print_r($eventsRaw['Tag']);
        $recipient = $eventsRaw["Recipient"];
        $subject = $eventsRaw["Details"];
        $message_id = $eventsRaw["MessageID"];
        $RecordType = $eventsRaw["RecordType"];
        $Tag = $eventsRaw["Tag"];
        $DeliveredAt = $eventsRaw["DeliveredAt"];
       

        // if (($subject == 'Software Development') || ($subject == 'Engineering') || ($subject == 'Systems and Database Operations') || ($subject == 'Accounting and Finance') || ($subject == 'Business Analysis and Project Management') || ($subject == 'Business Services')) {
            \Log::channel('customalert')->alert("Alert Mail Delivered to: ".$recipient.", subject: ".$subject.", message-id: ".$message_id.", Tag: ".$Tag.", RecordType: ".$RecordType.", DeliveredAt: ".$DeliveredAt);
        // }
        return response()->json(['status' => 200]);

    }

    public function getpostmarkNotdelivered(Request $request)
    {
        $events = json_decode(file_get_contents("php://input"));
        $eventsRaw = (array) $events;
        
        // if (($subject == 'Software Development') || ($subject == 'Engineering') || ($subject == 'Systems and Database Operations') || ($subject == 'Accounting and Finance') || ($subject == 'Business Analysis and Project Management') || ($subject == 'Business Services')) {
            // \Log::channel('customalert')->alert("Alert Mail Delivered to: ".$recipient.", subject: ".$subject.", message-id: ".$message_id);
          \Log::channel('customunsent')->alert($eventsRaw);
        // }

        return response()->json(['status' => 200]);

    }

    public static function getCat($args) {
    	$categoryName = JobCategory::select('title')->where('id',$args)->first()->title;
    	return $categoryName;
    }

    public static function getsubCat($args) {
        $categoryName = JobCategory::select(['title','categories'])->where('id',$args)->first()->toArray();
        return $categoryName;
    }
}
