<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BazaarCategory;
use App\Models\Bazaar;
use App\Models\BazaarImages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Image;

class BazaarController extends Controller
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
        $data = Bazaar::orderBy('id','DESC')->get();
    
        return view('bazaar.bazaar.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = BazaarCategory::where(['status' => 1,'parent_category' => 0])->get();

        return view('bazaar.bazaar.create',compact('categories'));
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
            'category_id' => 'required',
            'product' => 'required',
            'description' => 'required',
        ]);
        DB::beginTransaction();
        try{
            $product = new Bazaar();
            $product->category_id = $request->category_id;
            $product->sub_category_id = isset($request->sub_category_id)?$request->sub_category_id:0;
            $product->product = $request->product;
            $product->description = $request->description;
            $product->status = isset($request->status)?$request->status:0;

            $product->added_usertype = "admin";
            $product->added_by = Auth::user()->id;
            $product->save();

            if(isset($request->product_images)) {
                $request->validate([
                    'product_images[]' => 'image|mimes:jpg,jpeg,png|max:2048',
                ]);
                foreach ($request->product_images as $key => $images) {
                    if($images != "") {
                        $bazaarimage = new BazaarImages();
                        $bazaarimage->bazaar_id = $product->id;
                        $workFile = time().'_'.$images->getClientOriginalName(); 
                        // $images->move(public_path('uploads/bazaar/products'), $workFile);


                        $img = Image::make($images->path());

                        $img->resize(350, 240, function ($const) {
                            $const->aspectRatio();
                        })->save(public_path('uploads/bazaar/products') . '/' . $workFile);

                        $bazaarimage->product_image = $workFile;
                        $bazaarimage->save();
                    }
                }
            }

            DB::commit();

            return redirect()->route('bazaar-products.index')->with('success','Product created successfully.');

        } catch(Exception $e) {
            DB::rollback();
            return redirect()->route('bazaar-products.index')->with('danger',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Bazaar::with('bazaarimages')->where('id',$id)->firstOrFail();
        
        return view('bazaar.bazaar.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = BazaarCategory::where('status',1)->get();

        $data = Bazaar::with('bazaarimages')->where('id',$id)->firstOrFail();
        
        return view('bazaar.bazaar.edit',compact('data','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Bazaar::where('id',$id)->firstOrFail();

        $request->validate([
            'category_id' => 'required',
            'product' => 'required',
            'description' => 'required',
        ]);

        DB::beginTransaction();

        try{
            $product->category_id = $request->category_id;
            $product->sub_category_id = isset($request->sub_category_id)?$request->sub_category_id:0;
            $product->product = $request->product;
            $product->description = $request->description;
            $product->status = isset($request->status)?$request->status:0;

            $product->save();

            if($product->id != "") {
               
                if(isset($request->removeImg)) {
                    foreach ($request->removeImg as $key => $img) {
                        $removeimage = BazaarImages::where('id',$img)->firstOrFail();
                        unlink(public_path('uploads/bazaar/products/'.$removeimage->product_image));
                        $removeimage->delete();
                    }
                }

                if(isset($request->product_images)) {
                $request->validate([
                    'product_images[]' => 'image|mimes:jpg,jpeg,png|max:2048',
                ]);
                foreach ($request->product_images as $key => $images) {
                    if($images != "") {
                        $bazaarimage = new BazaarImages();
                        $bazaarimage->bazaar_id = $product->id;
                        $workFile = time().'_'.$images->getClientOriginalName(); 
                        // $images->move(public_path('uploads/bazaar/products'), $workFile);

                        $img = Image::make($images->path());

                        $img->resize(350, 240, function ($const) {
                            $const->aspectRatio();
                        })->save(public_path('uploads/bazaar/products') . '/' . $workFile);

                        $bazaarimage->product_image = $workFile;
                        $bazaarimage->save();
                    }
                }
            }
            }

            DB::commit();

            return redirect()->route('bazaar-products.index')->with('success','Product updated successfully.');

        } catch(Exception $e) {
            DB::rollback();
            return redirect()->route('bazaar-products.index')->with('danger',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Bazaar::with('bazaarimages')->where('id',$id)->firstOrFail();
        
        if($product != "") {
            if($product->bazaarimages != "") {
                foreach($product->bazaarimages as $key => $image) {
                    if($image->product_image != "") {
                        unlink(public_path('uploads/bazaar/products/'.$image->product_image));
                    }
                    $image->delete();
                }
            }

            $product->delete();
        }
    
        return redirect()->route('bazaar-products.index')
                        ->with('danger','Product deleted successfully');
    }

    public function approve($id)
    {
        $data = Bazaar::where('id',$id)->firstOrFail();

        $data->status = 1;
        $data->save();
        
        return redirect()->route('bazaar-products.show',[$data->id])->with('success','Product approved successfully');
    }

    public function reject($id)
    {
        $data = Bazaar::where('id',$id)->firstOrFail();

        $data->status = -1;
        $data->save();
        
        return redirect()->route('bazaar-products.show',[$data->id])->with('danger','Product rejected successfully');
    }

}
