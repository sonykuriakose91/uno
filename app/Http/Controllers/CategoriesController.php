<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
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
        $data = Categories::with('parentcategory')->whereIN('status', [0,1])->orderBy('id','DESC')->get();
    
        return view('categories.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $request->validate([
            'category' => 'required',
            'main_category' => 'required',
            // 'category_icon' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        $category = new Categories();
        $category->main_category = $request->main_category;
        $category->category = $request->category;
        $category->parent_category = ($request->parent_category != '')?$request->parent_category:0;
        $category->description = isset($request->description)?$request->description:"";
        $category->status = isset($request->status)?$request->status:0;
        if(isset($request->category_icon) && $request->category_icon != "") {
            $fileName = time().'_'.$request->category_icon->getClientOriginalName();  
           
            $request->category_icon->move(public_path('uploads/categories/icons'), $fileName);
            $category->icon = $fileName;
        } else {
            $category->icon = "";
        }
        $category->save();
     
        return redirect()->route('categories.index')
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
        $category = Categories::findOrFail($category_id);

        $data = Categories::where(['main_category' => $category->main_category, 'parent_category' => 0,'status' => 1])->get();

        return view('categories.edit',compact('category','data'));
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
            'main_category' => 'required',
        ]);

        $category = Categories::findOrFail($category_id);
        $old_icon = $category->icon;
        $category->category = $request->category;
        $category->main_category = $request->main_category;
        $category->parent_category = ($request->parent_category != '')?$request->parent_category:0;
        $category->description = $request->description;
        $category->status = isset($request->status)?$request->status:0;
        if($request->category_icon != "") {
            $request->validate([
                'category_icon' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048',
            ]);
            if($old_icon != "") {
                unlink(public_path('uploads/categories/icons/'.$old_icon));
            }
            
            $fileName = time().'_'.$request->category_icon->getClientOriginalName(); 
            $request->category_icon->move(public_path('uploads/categories/icons'), $fileName);
            $category->icon = $fileName;
        } else {
            $category->icon = $old_icon;
        }
        $category->save();
     
        return redirect()->route('categories.index')
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
        $category = Categories::findOrFail($category_id);
        
        if($category != "") {

            if($category->icon != "") {
                unlink(public_path('uploads/categories/icons/'.$category->icon));
            }
            
            $category->delete();

            return redirect()->route('categories.index')->with('success','Category deleted successfully');
        } else { 
            return redirect()->route('categories.index')->with('danger','Something went wrong.!');
        }
        
    }

    public function getsubcategory(Request $request) {

        $categoryData = "";

        $maincategory = $request->maincategory;

        $categories = Categories::where(['parent_category' => 0, 'main_category' => $maincategory,'status' => 1])->get();

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
