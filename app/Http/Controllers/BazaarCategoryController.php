<?php

namespace App\Http\Controllers;

use App\Models\BazaarCategory;
use Illuminate\Http\Request;

class BazaarCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = BazaarCategory::with('parentcategory')->whereIN('status', [0,1])->orderBy('id','DESC')->get();
    
        return view('bazaar.categories.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = BazaarCategory::where('status',1)->get();

        return view('bazaar.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
        ]);

        $category = new BazaarCategory();
        $category->category = $request->category;
        $category->parent_category = ($request->parent_category != '')?$request->parent_category:0;
        $category->description = isset($request->description)?$request->description:"";
        $category->status = isset($request->status)?$request->status:0;
        $category->save();
     
        return redirect()->route('bazaar-category.index')
                        ->with('success','Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($category_id)
    {
        $data = BazaarCategory::where(['id' => $category_id])->first();

        $categories = BazaarCategory::where('status',1)->whereNotIn('id',[$data->id])->get();

        return view('bazaar.categories.edit',compact('categories','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category_id)
    {
        $request->validate([
            'category' => 'required',
        ]);

        $category = BazaarCategory::findOrFail($category_id);
        $category->category = $request->category;
        $category->parent_category = ($request->parent_category != '')?$request->parent_category:0;
        $category->description = $request->description;
        $category->status = isset($request->status)?$request->status:0;
        $category->save();
     
        return redirect()->route('bazaar-category.index')
                        ->with('success','Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($category_id)
    {
        $category = BazaarCategory::findOrFail($category_id);
        
        if($category != "") {
            
            $category->delete();

            return redirect()->route('bazaar-category.index')->with('success','Category deleted successfully');
        } else { 
            return redirect()->route('bazaar-category.index')->with('danger','Something went wrong.!');
        }
        
    }

    public function getsubcategory(Request $request) {

        $categoryData = "";

        $categories = BazaarCategory::where(['parent_category' => $request->category,'status' => 1])->get();

        if($categories != "") {
            $categoryData.='<option value="">Select</option>';
            foreach($categories as $key => $cate) {
                $categoryData.='<option value="'.$cate->id.'">'.$cate->category.'</option>';
            }

        } else {
            $categoryData.='<option value="">Select</option>';
        }

        return $categoryData;
    }
}
