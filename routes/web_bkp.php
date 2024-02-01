<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobCategoriesController;
use App\Http\Controllers\SubscribersController;
use App\Models\JobCategory;
use App\Http\Controllers\SendEmailController;
// use DB;

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
	$categories = JobCategory::select("*")->get();
	return view('welcome',compact('categories'));
    // return view('welcome');
});
Route::resource('job-alert', SubscribersController::class); 

Route::get('/send-email/{$details}', [SendEmailController::class, 'index'])->name('send-email');

Route::get('/my-home', [App\Http\Controllers\HomeController::class, 'myHome'])->name('home');

Route::get('/my-users', [App\Http\Controllers\HomeController::class, 'myUsers'])->name('users');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/job-categories', [App\Http\Controllers\JobCategoriesController::class, 'index'])->name('Job Category'); 
// Route::post('/job-categories/destroy', [App\Http\Controllers\JobCategoriesController::class, 'destroy'])->name('Job Category'); 
// Route::get('/job-categories/show', [App\Http\Controllers\JobCategoriesController::class, 'show'])->name('Job Category'); 
// Route::get('/job-categories/edit', [App\Http\Controllers\JobCategoriesController::class, 'edit'])->name('Job Category'); 
Route::resource('job-categories', JobCategoriesController::class);  
// Route::post('job-categories/store', [App\Http\Controllers\JobCategoriesController::class, 'store']); 
Route::resource('subscribers', SubscribersController::class); 
// routes/web.php



//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
