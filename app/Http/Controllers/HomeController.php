<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Models\JobCategory;
use App\Models\EmailLog;
use App\Models\UnsubscriberLog;
use Illuminate\Http\Request;
use Carbon\Carbon;use Hash;
use Illuminate\Support\Facades\Crypt;
use \Rap2hpoutre\LaravelLogViewer\LaravelLogViewer;
use Illuminate\Support\Facades\Cache;
use Auth;

class HomeController extends Controller
{


   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $subscribers = Subscriber::all();
        $subCount = $subscribers->count();
        $Actsubscribers = Subscriber::whereNull('unsubscription_date')->get();
        $actCount = $Actsubscribers->count();
        $Deactsubscribers = Subscriber::whereNotNull('unsubscription_date')->get();
        $deactCount = $Deactsubscribers->count();
        $emailCount = EmailLog::where('id', '>', 0)->count();


        $ActSubs = $Actsubscribers->toArray();
        $estimated = 0;
        if(date('D') == 'Tue') { 
        
          foreach ($ActSubs as $value) {
            $estimated = $estimated + substr_count( $value['opted_for'], ",") +1;
          }
          

        }
        
        $emailQueued = EmailLog::selectRaw('COUNT(*) as count')->where('created_at', 'like', '%' . date('Y-m-d') . '%')->get()->toArray();

        $log_viewer = new LaravelLogViewer();
        $logs = $log_viewer->all();
        $mailGunSends = count($logs);
        $mailGunCount = 0;
        foreach ($logs as $key => $log) {
          if (date("Y-m-d", strtotime($log['date'])) == date("Y-m-d")) {
            $mailGunCount++;
          }
        }

        $notSent = $emailQueued[0]['count'] - $mailGunCount;

        $subdata = Subscriber::selectRaw('COUNT(*) as count, YEAR(subscription_date) year, MONTHNAME(subscription_date) month')->whereNull('unsubscription_date')->groupBy('year', 'month')->get()->toArray();

        $unsubdata = Subscriber::selectRaw('COUNT(*) as count, YEAR(unsubscription_date) year, MONTHNAME(unsubscription_date) month')->whereNotNull('unsubscription_date')->groupBy('year', 'month')->get()->toArray();

        $emailChart = EmailLog::selectRaw('COUNT(*) as count, YEAR(created_at) year, MONTHNAME(created_at) month, WEEK(created_at) week')->whereBetween('created_at', [Carbon::now()->subWeeks(6), Carbon::now()])->groupBy('year', 'month', 'week')->get()->toArray();

        return view('home')->with('actCount',$actCount)->with('deactCount',$deactCount)->with('subCount',$subCount)->with('emailCount',$emailCount)->with('subdata',$subdata)->with('unsubdata',$unsubdata)->with('emailChart', $emailChart)->with('estimated', $estimated)->with('emailQueued', $emailQueued)->with('mailGunCount', $mailGunCount)->with('notSent', $notSent);

    }


    public function profile()
    {
      return view('profile');
      // echo "Hello Home";
    }

    public function changePasswordPost (Request $request)
    {
      if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
          // The passwords matches
          return redirect()->back()->with("error","Your current password does not matches with the password.");
      }

      if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            // Current password and new password same
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
      }

      $validatedData = $request->validate([
          'current-password' => 'required',
          'new-password' => 'required|string|min:8|confirmed',
      ]);

      //Change Password
      $user = Auth::user();
      $user->password = bcrypt($request->get('new-password'));
      $user->save();

      return redirect()->back()->with("success","Password successfully changed!");
      
    }
    
    public function changeUsernamePost (Request $request)
    {

      $validatedData = $request->validate([
          'name' => 'required|string|min:6',
      ]);

      //Change UserName
      $user = Auth::user();
      $user->name = $request->get('name');
      $user->save();

      return redirect()->back()->with("success","User name successfully changed!");
      
    }
    public function changeEmailPost (Request $request)
    {

      $validatedData = $request->validate([
          'email' => 'required|string|email|max:255',
      ]);

      //Change Email
      $user = Auth::user();
      $user->email = $request->get('email');
      $user->save();

      Auth::logout();
      return redirect('/login');
      
    }

     /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
   public function myHome()
   {
       return view('myHome');
        // echo "Hello Home";
   }
   /**
    * Show the my users page.
    *
    * @return \Illuminate\Http\Response
    */
   public function myUsers()
   {
       return view('myUsers');
   }


    public function getravchartdata()
    {
       
        $subdata = Subscriber::selectRaw('COUNT(*) as count, YEAR(subscription_date) year, MONTHNAME(subscription_date) month')->groupBy('year', 'month')->get()->toArray();

        $unsubdata = Subscriber::selectRaw('COUNT(*) as count, YEAR(unsubscription_date) year, MONTHNAME(unsubscription_date) month')->whereNotNull('unsubscription_date')->groupBy('year', 'month')->get()->toArray();
        
        $arr = [];

        $subArr = [];
        foreach ($subdata as $value) {
          
          $subArr[$value['month']." ".$value['year']] = $value['count'];
        }
          

        $unsubArr = [];
        foreach ($unsubdata as $values) {
         
          $unsubArr[$values['month']." ".$values['year']] = $values['count'];
        }
        

        $lab = date("F Y");for ($i = 1; $i < 6; $i++) {$lab .= date(",F Y", strtotime("-$i month"));}

        $SArr = array_reverse(explode(",", $lab));
        $subdataArr =  [];
        foreach ($SArr as $value) {
          if (array_key_exists($value,$subArr))
          {
            
            array_push($subdataArr, $subArr[$value]);
          }
          else{
            array_push($subdataArr, 0);
          }
        }


       
        $unsubdataArr =  [];
        foreach ($SArr as $value) {
          if (array_key_exists($value,$unsubArr))
          {
            array_push($unsubdataArr, $unsubArr[$value]);
          }
          else{
            array_push($unsubdataArr, 0);
          }
        }


        array_push($arr, array("month"=>$SArr,"subcount"=>$subdataArr,"unsubcount"=>$unsubdataArr));

        return $arr;
        
    }

    public function gettodaysdata()
    {
      $subToday = Subscriber::selectRaw('COUNT(*) as count')->whereNull('unsubscription_date')->whereDate('subscription_date', Carbon::today())->get()->toArray();
      $unsubToday = Subscriber::selectRaw('COUNT(*) as count')->whereNotNull('unsubscription_date')->whereDate('unsubscription_date', Carbon::today())->get()->toArray();
      $emailToday = EmailLog::selectRaw('COUNT(*) as count')->whereDate('created_at', Carbon::today())->get()->toArray();
      
      $arr = [];
      array_push($arr, array("subToday"=>$subToday[0]['count'],"unsubToday"=>$unsubToday[0]['count'],"emailToday"=>$emailToday[0]['count']));
      
      return $arr;
        
    }


    public function getnotifydata()
    {
      $unsubCount = UnsubscriberLog::selectRaw('COUNT(*) as count')->where('notify', 1)->get()->toArray();
      $alertCount = EmailLog::selectRaw('COUNT(*) as count')->where('is_active', 1)->get()->toArray();
     
      $notify = 0;
      if($unsubCount[0]['count'] > 0){
        $notify = 1;
      }
      if($alertCount[0]['count'] > 0){
        $notify = $notify + 1;
      }
      $arr = [];
      
      array_push($arr, array("unsubCount"=>$unsubCount[0]['count'],"alertCount"=>$alertCount[0]['count'],"notify"=>$notify));
      
      return $arr;
        
    }
    
    public function getcalendardata()
    {
      $sdate = date('Y-m-d',strtotime($_GET['sdate']));

      $subToday = Subscriber::selectRaw('COUNT(*) as count')->whereDate('subscription_date', $sdate)->get()->toArray();
      $unsubToday = Subscriber::selectRaw('COUNT(*) as count')->whereNotNull('unsubscription_date')->whereDate('unsubscription_date', $sdate)->get()->toArray();
      $emailToday = EmailLog::selectRaw('COUNT(*) as count')->whereDate('created_at', $sdate)->get()->toArray();
      
      $arr = [];
      array_push($arr, array("c_sub"=>$subToday[0]['count'],"c_unsub"=>$unsubToday[0]['count'],"c_email"=>$emailToday[0]['count']));
      
      return $arr;
      // return $_GET['sdate'];
    }

    public function clearAllCache(){
      Cache::flush();
    }

}
