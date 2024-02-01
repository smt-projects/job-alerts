<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use Illuminate\Http\Request;
use DB;

class JobCategoriesController extends Controller
{
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
            ->orderby('job_categories.created_at','DESC')->paginate(3);
        // $JobCategory = JobCategory::where('id', $productId)
        //     ->leftJoin('category', 'product.category', '=', 'category.id')
        //     ->select('product.id','category.name')->first();

            // echo "<pre>";print_r($categories);
        return view('categories.index',compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 3);

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
        return view('categories.create');
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
            // 'detail' => 'required',
        ]);
    

        $request->request->add(['is_active' => '1']);
        // JobCategory::create($request->all());
        // print_r($request->title);
        $ins = [
            'title' => $request->title,
            'created_by' => auth()->id(),
            'is_active' => $request->is_active, 
        ];
        // print_r($ins);
        JobCategory::create([

            'title' => $request->title,
            'created_by' => auth()->id(),
            'is_active' => $request->is_active, 
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
        // $request->validate([
        //     'name' => 'required',
        // ]);
        echo $JobCategory;
        print_r($request->is_active);

        $JobCategory->update($request->all());

        

        // $cats = JobCategory::find($JobCategory);
 
        // $cats->is_active = $request->is_active;
         
        // $cats->save();
        // DB::enableQueryLog();
        // JobCategory::where('id', $JobCategory)
        //       ->where('title', $request->title)
        //       ->update(['created_by' => auth()->id(), 'is_active' => $request->is_active]);

        // $query = DB::getQueryLog();
        // dd($query);
        // JobCategory::update(['title' => $request->title,
        //     'created_by' => auth()->id(),
        //     'is_active' => $request->is_active]);
    
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
}
