<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use Illuminate\Http\Request;
use DB;
use App\Models\EmailLog;
use Illuminate\Support\Facades\Http;
use Auth;

class JobCategoriesController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $categories = JobCategory::latest()->paginate(5);
        $categories = JobCategory::leftJoin('users', 'job_categories.created_by', '=', 'users.id')
            ->select('*','job_categories.id AS cat_id')
            ->orderby('job_categories.created_at','DESC')->paginate(10);

        return view('categories.index',compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function catApi(){
        
        $apiURL = 'https://vanderhouwen.com/wp-json/vanderhouwen/v1/cat_searches';

       
        $response = Http::get($apiURL);
        $responseBody = json_decode($response->body(), true);
        return stripcslashes($responseBody.'\r\n');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cathtml = $this->catApi();

        return view('categories.create',compact('cathtml'));
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
            'title' => 'required',
        ]);
    

        $request->request->add(['is_active' => '1']);
        
        $ins = [
            'title' => $request->title,
            'created_by' => auth()->id(),
            'is_active' => $request->is_active, 
            'categories' => implode(',', $request->categories), 
        ];
        
        JobCategory::create([
            'title' => $request->title,
            'created_by' => auth()->id(),
            'is_active' => $request->is_active, 
            'categories' => implode(',', $request->categories), 
        ]);
     
        return redirect()->route('job-categories.index')
                        ->with('success','Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, JobCategory $JobCategory)
    {
        echo $JobCategory;
        print_r($request->is_active);

        $JobCategory->update($request->all());

    
        return redirect()->route('job-categories.index')
                        ->with('success','Categories updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobCategory $JobCategory)
    {
        $JobCategory->delete();
    
        return redirect()->route('job-categories.index')
                        ->with('success','Category deleted successfully');
    }

    public static function getCat($args) {
        $categoryName = JobCategory::select('title')->where('id',$args)->get();
        return $categoryName;
    }
    
    public static function getrestCat($args) {
        $categories = JobCategory::whereNotIn('id', explode(',', $args))->where('is_active', 1)->get();
        return $categories;
    }

    public static function getEmailCount($args){
        $emailCount = EmailLog::where('subscriber_id',$args)->count();
        return $emailCount;
    }
}
