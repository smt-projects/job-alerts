<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use DB;
use Mail;
 
use App\Mail\NotifyMail;


class SubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $subscribers = Subscriber::all();
        return view('subscribers.index',compact('subscribers'));

        /*$categories = JobCategory::leftJoin('users', 'job_categories.created_by', '=', 'users.id')
            ->select('*','job_categories.id AS cat_id')
            ->orderby('job_categories.created_at','DESC')->paginate(3);*/


        // $JobCategory = JobCategory::where('id', $productId)
        //     ->leftJoin('category', 'product.category', '=', 'category.id')
        //     ->select('product.id','category.name')->first();

            // echo "<pre>";print_r($categories);


        /*return view('categories.index',compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 3);*/

        // return view('category');
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
    

        // $request->request->add(['is_active' => '1']);
        // JobCategory::create($request->all());
        // print_r($request->title);
        
        $opted_for = implode(",", $request->opted_for);
        
        $details = [
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'opted_for' => $opted_for,
            'subscription_date' => date('Y-m-d h:m:s'), 
        ];
        // print_r($ins);
        Subscriber::create([

            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'opted_for' => $opted_for,
            'subscription_date' => date('Y-m-d h:m:s'), 
        ]);
     

     	// return redirect()->route('send-email')
      //                   ->with('details',$details);
        // return redirect()->route('job-alert.show.')
        //                 ->with('success','Job Alert subcription done successfully.');
        // return view('thankyou')->with('success','Job Alert subcription done successfully.');
        $success = $this->sendmail($details);
        return view('thankyou')->with(['success'=> $success]);
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
        // $request->validate([
        //     'name' => 'required',
        // ]);
        // echo $JobCategory;
        // print_r($Subscriber->id);

        // $Subscriber->update($request->all());

        

        // $subs = Subscriber::find($Subscriber);
 
        // $subs->unsubscription_date = date('Y-m-d h:i:s');
         
        // $subs->save();
        // DB::enableQueryLog();
        Subscriber::where('id', $Subscriber->id)
              ->update(['unsubscription_date' => date('Y-m-d h:i:s')]);

        // $query = DB::getQueryLog();
        // dd($query);
        // JobCategory::update(['title' => $request->title,
        //     'created_by' => auth()->id(),
        //     'is_active' => $request->is_active]);
    
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
 		// $details = [
	  //       'title' => 'Mail from Vanderhowen Job Alert',
	  //       'body' => 'This is for testing email using smtp'
	  //   ];
	   $details['title'] = 'Mail from Vanderhowen Job Alert';
	    // \Mail::to('dmarkus774@gmail.com')->send(new \App\Mail\NotifyMail($details));
	   
	    // dd("Email is Sent.");
	    // dd($details);


      Mail::to('dmarkus774@gmail.com')->send(new NotifyMail($details));
 
      if (Mail::failures()) {
           return response()->Fail('Sorry! Please try again latter');
      }else{
           return response()->success('Great! Successfully send in your mail');
         }
    }


    public static function getCat($args) {
    	$categoryName = JobCategory::select('title')->where('id',$args)->get();
    	return $categoryName;
    }
}
