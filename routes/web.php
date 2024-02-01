<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobCategoriesController;
use App\Http\Controllers\SubscribersController;
use App\Models\JobCategory;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\EmailLogsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmailListenersController;
use App\Models\Subscriber;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
$details = Session::get('details');
Route::get('/', function () {
	$categories = JobCategory::select('*')->where('is_active',1)->get();
	//return view('welcome',compact('categories'));

	$subscriber = null;
	if(isset($_GET['sid'])){
		$subid = base64_decode($_GET['sid']);
		$subscriber = Subscriber::select('*')->where('id',$subid)->get();
	}
	//print_r($subscriber);
	return view('welcome',compact(['categories','subscriber']));
});

Route::get('/thankyou', function () {
	return view('thankyou');
});

Route::resource('job-alert', SubscribersController::class); 

Route::get('/send-email/{$details}', [SendEmailController::class, 'index'])->name('send-email');

Route::get('/my-home', [App\Http\Controllers\HomeController::class, 'myHome'])->name('home');

Route::get('/my-users', [App\Http\Controllers\HomeController::class, 'myUsers'])->name('users');

Route::get('/api-call', [EmailLogsController::class, 'callApi'])->name('get-emailcontent');
Route::get('/job-alerts', [EmailLogsController::class, 'sendJobAlert'])->name('job-alert'); 
Route::get('/testjob-alerts', [EmailLogsController::class, 'sendTestJobAlert'])->name('job-alerts'); 

Route::get('/updateSubscriberOptedinSelf/{token}/{subid}/{catid}', [SubscribersController::class, 'updateSubscriberOptedinSelf'])->name('updateSubscriberOptedinSelf');

Route::get('send_test_email', function(){
	$details['label'] = 'POSTMARK API and Laravel are awesome! Tests.';
	$details['mailCont'] = '<h1>Sending emails with Postmark API and Laravel is easy! Vanderhouwen STAG</h1>';
	$details['mailfor'] = 'qateam@ironglovestudio.net';
	$ress = Mail::send([], [], function ($message) use ($details)
	{
		$message->subject($details['label']);
		$message->from('wordpress@vanderhouwen.com', 'Vanderhouwen Job Alerts');
		$message->to($details['mailfor']);
		$message->setBody($details['mailCont'], 'text/html');
	});

	if (Mail::failures()) {
	    echo "Not Sent";
	    \Log::channel('customerror')->info(Mail::failures());
	}else{
        echo "Sent";
        echo "<pre>";print_r($ress);
     }
});


Route::get('/clearCache', [App\Http\Controllers\HomeController::class, 'clearAllCache'])->name('clearAllCache');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');

Route::post('/changePassword', [App\Http\Controllers\HomeController::class, 'changePasswordPost'])->name('changePasswordPost');

Route::post('/changeUsername', [App\Http\Controllers\HomeController::class, 'changeUsernamePost'])->name('changeUsernamePost');

Route::post('/changeEmail', [App\Http\Controllers\HomeController::class, 'changeEmailPost'])->name('changeEmailPost');

Route::resource('job-categories', JobCategoriesController::class);  
Route::resource('subscribers', SubscribersController::class); 

Route::resource('emaillogs', EmailLogsController::class);
Route::get('getemaillogs', [EmailLogsController::class, 'getemaillogs'])->name('getemaillogs');
Route::get('getEmaildata', [EmailLogsController::class, 'getEmaildata'])->name('getEmaildata');
// routes/web.php

Route::post('/updateSubscriber', [SubscribersController::class, 'updateSubscriber'])->name('updateSubscriber');
Route::post('/updateSubscriberOptedin', [SubscribersController::class, 'updateSubscriberOptedin'])->name('updateSubscriberOptedin');
Route::post('/updateSubscriberOptedout', [SubscribersController::class, 'updateSubscriberOptedout'])->name('updateSubscriberOptedout');

Route::get('/getravchartdata', [HomeController::class, 'getravchartdata'])->name('getravchartdata');

Route::get('/gettodaysdata', [HomeController::class, 'gettodaysdata'])->name('gettodaysdata');

Route::get('/getnotifydata', [HomeController::class, 'getnotifydata'])->name('getnotifydata');

Route::get('/getcalendardata', [HomeController::class, 'getcalendardata'])->name('getcalendardata');

//Auth::routes();
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);