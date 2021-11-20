<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $brands = Brand::orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $brands = $brands->where('name', 'like', '%'.$sort_search.'%');
        }
        $brands = $brands->paginate(15);
        return view('brands.index', compact('brands', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.create');  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brand = new Brand;
        $brand->name = $request->name;
        $brand->meta_title = $request->meta_title;
        $brand->meta_description = $request->meta_description;
        if ($request->slug != null) {
            $brand->slug = str_replace(' ', '-', $request->slug);
        }
        else {
            $brand->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }
        if($request->hasFile('logo')){
            $brand->logo = $request->file('logo')->store('uploads/brands');
        }

        if($brand->save()){
            flash(translate('Brand has been inserted successfully'))->success();
            return redirect()->route('brands.index');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function seller_add_brands(Request $request)
    {
        $brand = new Brand;
        $brand->name = $request->name;
        $brand->meta_title = $request->meta_title;
        $brand->meta_description = $request->meta_description;
        if ($request->slug != null) {
            $brand->slug = str_replace(' ', '-', $request->slug);
        }
        else {
            $brand->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }
        if($request->hasFile('logo')){
            $brand->logo = $request->file('logo')->store('uploads/brands');
        }

        if($brand->save()){
            flash(translate('Brand request has been sent successfully'))->success();
            return redirect()->route('seller.products.upload');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }
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
        $brand = Brand::findOrFail(decrypt($id));
        return view('brands.edit', compact('brand'));
    }

    public function approve($id){
        $brand = Brand::findOrFail(decrypt($id));
        $brand->status = 1;
        $brand->save();
        flash(translate('Brand approved successfully'))->success();
            return redirect()->back();
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
        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;
        $brand->meta_title = $request->meta_title;
        $brand->meta_description = $request->meta_description;
        if ($request->slug != null) {
            $brand->slug = str_replace(' ', '-', $request->slug);
        }
        else {
            $brand->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }
        if($request->hasFile('logo')){
            unlink(public_path().'/'.$brand->logo);
            $brand->logo = $request->file('logo')->store('uploads/brands');
        }

        if($brand->save()){
            flash(translate('Brand has been updated successfully'))->success();
            return redirect()->route('brands.index');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
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
        $brand = Brand::findOrFail($id);
        $image_path = $brand->logo;  // Value is not URL but directory file path
        
        // dd($image_path);
        // dd(File::exists($image_path));
        // if(File::exists($image_path)) {
        // }
        Product::where('brand_id', $brand->id)->delete();
        if(Brand::destroy($id)){
            if($brand->logo != null){
                unlink(public_path().'/'.$brand->logo);
                // File::delete($image_path);
               
            }
            flash(translate('Brand has been deleted successfully'))->success();
            return redirect()->route('brands.index');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    public function delete($id)
    {
        $brand = Brand::findOrFail($id);
        $image_path = $brand->logo;  // Value is not URL but directory file path
        
        // dd($image_path);
        // dd(File::exists($image_path));
        // if(File::exists($image_path)) {
        // }
        Product::where('brand_id', $brand->id)->delete();
        if(Brand::destroy($id)){
            if($brand->logo != null){
                unlink(public_path().'/'.$brand->logo);
                // File::delete($image_path);
               
            }
            flash(translate('Brand has been deleted successfully'))->success();
            return redirect()->route('brands.index');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }
}
