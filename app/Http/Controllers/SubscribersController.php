<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Models\JobCategory;
use App\Models\UnsubscriberLog;
use Illuminate\Http\Request;
use DB;
use Mail;
 
use App\Mail\NotifyMail;
use App\Mail\NotifySubscriber;
use Auth;


class SubscribersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['store','updateSubscriberOptedinSelf']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        UnsubscriberLog::where('notify', 1)
                          ->update(['notify' => 0]);
                          
        $subscribers = Subscriber::all();
        return view('subscribers.index',compact('subscribers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'opted_for' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
        ]);
    
        $opted_for = implode(",", $request->opted_for);
        
        $details = [
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'opted_for' => $opted_for,
            'subscription_date' => date('Y-m-d h:m:s'), 
        ];
        
        $userCount = Subscriber::where('email',$request->email)->count();
        Subscriber::updateOrCreate(
            ['email' => $request->email],
            ['fname' => $request->fname, 'lname' => $request->lname, 'opted_for' => $opted_for, 'subscription_date' => date('Y-m-d h:m:s'), 'unsubscription_date' => NULL]
        );

        $categoriess = JobCategory::whereIn('id', $request->opted_for)->where('is_active', 1)->get()->toArray();
        // echo "<pre>";print_r($categoriess);
        $catsArr = [];
        foreach ($categoriess as $value) {
            array_push($catsArr, $value['title']);
        }
        $details['subFor'] = implode(", ", $catsArr);
        // die();

        $subsid = Subscriber::select('id')->where('email',$request->email)->first()->id;
        $details['subid'] = $subsid;

        if ($userCount) {
          
          $details['type'] = 'update';
        }
        else{
          
          $details['type'] = 'new';
        }
        
        $success = $this->sendmail($details);
        return redirect('/thankyou');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Subscriber $subscriber)
    {
        // return view('thankyou');

        return view('subscribers.show',compact('subscriber'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscriber $Subscriber)
    {
        // DB::enableQueryLog();
        Subscriber::where('id', $Subscriber->id)
              ->update(['unsubscription_date' => date('Y-m-d h:i:s')]);
    
        return redirect()->route('subscribers.index')
                        ->with('success','Subscribers updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $Subscriber)
    {
        $Subscriber->delete();
    
        return redirect()->route('subscribers.index')
                        ->with('success','Subscriber deleted successfully');
    }

    public function sendmail($details)
    {
	    $details['title'] = 'Mail from VanderHowen Job Alert';

        if($details['type'] == 'update'){
            $details['title'] = 'You\'ve Updated Your Job Alert Preferences';
        }

        $Subtemplate = view('emails.welcomeMail', compact('details'))->render();
        $Admintemplate = view('emails.subscriptionMail', compact('details'))->render();
        $datas = array(
            "From" => env('MAIL_USERNAME', 'jobalert@vanderhouwen.com'),
            "To" => $details['email'],
            "Subject" => $details['title'],
            "Tag" => "Job Subscription",
            "HtmlBody" => $Subtemplate,
            "MessageStream" => "outbound"
        );

        $Admindatas = array(
            "From" => env('MAIL_USERNAME'),
            "To" => 'newsletter@vanderhouwen.com',
            "Subject" => $details['title'],
            "Tag" => "Job Subscription",
            "HtmlBody" => $Admintemplate,
            "MessageStream" => "outbound"
        );
    
        // echo "<pre>";print_r($datas);
        
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.postmarkapp.com/email',
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
        // echo $response;
        
        $curl1 = curl_init();
    
        curl_setopt_array($curl1, array(
        CURLOPT_URL => 'https://api.postmarkapp.com/email',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>json_encode($Admindatas),
        CURLOPT_HTTPHEADER => array(
            'X-Postmark-Server-Token: 1c48969e-40ae-43c9-a2e4-60c1ab00ec20',
            'Content-Type: application/json'
        ),
        ));
    
        $response1 = curl_exec($curl1);
    
        curl_close($curl1);

        return 'Great! Successfully send in your mail';

    }


    public static function getCat($args) {
    	$categoryName = JobCategory::select('title')->where('id',$args)->get();
    	return $categoryName;
    }


    public function updateSubscriber(Request $request)
    {
        // print_r($request->all());
        if ($request->yesno == 'no') {
           Subscriber::where('id', $request->subid)
              ->update(['unsubscription_date' => date('Y-m-d h:i:s')]);
        }else{
            Subscriber::where('id', $request->subid)
              ->update(['unsubscription_date' => NULL]);
        }
        
    }

    public function updateSubscriberOptedin(Request $request)
    {
        
        $categories = Subscriber::select('opted_for')->where('id',$request->subid)->first()->opted_for;
        $categoriesArr = explode(",", $categories);
        if (($key = array_search($request->opted_for, $categoriesArr)) !== false) {
            unset($categoriesArr[$key]);
        }
        $opted_for = implode(",", $categoriesArr);
        Subscriber::where('id', $request->subid)
              ->update(['opted_for' => $opted_for]);

        return "success";
        
    }
    
    public function updateSubscriberOptedout(Request $request)
    {
        
        $categories = Subscriber::select('opted_for')->where('id',$request->subid)->first()->opted_for;
        $categoriesArr = explode(",", $categories);
        
        array_push($categoriesArr, $request->opted_for);
        $opted_for = implode(",", $categoriesArr);
        Subscriber::where('id', $request->subid)
              ->update(['opted_for' => $opted_for]);

        return "success";
        
    }

    // public function updateSubscriberOptedinSelf($token, $subid, $catid)
    public function updateSubscriberOptedinSelf($token, $subid, $catid)
    {
        
        $categories = Subscriber::select('opted_for')->where('unsubscription_date', NULL)->where('id',$subid)->get();
        
        if ($categories->count() > 0) {
            $cats = $categories->toArray();

            $categoriesArr = explode(",", $cats[0]['opted_for']);
            // print_r($categoriesArr);
            if (in_array($catid, $categoriesArr)) {
                // echo $catid."<br>";
                if (($key = array_search($catid, $categoriesArr)) !== false) {
                    unset($categoriesArr[$key]);
                }
                if (count($categoriesArr) > 0) {
                    
                    $opted_for = implode(",", $categoriesArr);
                    
                    Subscriber::where('id', $subid)
                          ->update(['opted_for' => $opted_for]);

                    UnsubscriberLog::create([
                        'subscriber_id' => $subid,
                        'unsubscribed_for' => $catid, 
                        'notify' => 1,
                    ]);

                    echo "<h3>You are successfully unsubscribed for the Job Alert!!!</h3>";
                }
                else {
                    
                    $opted_for = NULL;
                    
                    Subscriber::where('id', $subid)
                          ->update(['opted_for' => $opted_for,'unsubscription_date' => date('Y-m-d h:i:s')]);

                    UnsubscriberLog::create([
                        'subscriber_id' => $subid,
                        'unsubscribed_for' => $catid, 
                        'notify' => 1,
                    ]);
                    echo "<h3>You are successfully unsubscribed for the Job Alert!!!</h3>";

                }
            }else{
                echo "<h3>You are already unsubscribed for the Job Alert!!!</h3>";
            }
        }else{
            echo "<h3>You are not subscribed for the Job Alert!!!</h3>";
        }
        
        echo "<script>setTimeout(function(){ window.location.href = 'https://www.vanderhouwen.com/job-postings/'; }, 3000);</script>";
        
    }
}
