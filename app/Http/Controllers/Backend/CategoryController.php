<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function AllCategory(){
        $category =Category::latest()->get();
        return view('admin.backend.category.all_category',compact('category'));
    }
    //End Method

    public function AddCategory(){
        return view('admin.backend.category.add_category');
    }// End  Method

    public function StoreCategory(Request $request){
        $image=$request->file('image');
        $imageName=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370,246)->save('uploads/category/'.$imageName);
        $save_url='uploads/category/'.$imageName;

        Category::insert([
            'category_name'=>$request->category_name,
            'category_slug'=>strtolower(str_replace(' ','-',$request->category_name)),
            'image'=> $save_url,
        ]);

        $notification = array(
            'message' =>'Category created successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('all.category')->with($notification);
    }// End Method

    public function EditCategory($id){
        $category=Category::find($id);
        return view('admin.backend.category.edit_category',compact('category'));
    }//End Method

    public function UpdateCategory(Request $request){
        $cat_id=$request->id;
        if($request->file('image')){
            $image=$request->file('image');
            $imageName=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(370,246)->save('uploads/category/'.$imageName);
            $save_url='uploads/category/'.$imageName;
    
            Category::find($cat_id)->update([
                'category_name'=>$request->category_name,
                'category_slug'=>strtolower(str_replace(' ','-',$request->category_name)),
                'image'=> $save_url,
            ]);
    
            $notification = array(
                'message' =>'Category updated with image successfully',
                'alert-type'=>'success',
            );
            return redirect()->route('all.category')->with($notification);
        }else{
            Category::find($cat_id)->update([
                'category_name'=>$request->category_name,
                'category_slug'=>strtolower(str_replace(' ','-',$request->category_name)),
            ]);
    
            $notification = array(
                'message' =>'Category updated without image successfully',
                'alert-type'=>'success',
            );
            return redirect()->route('all.category')->with($notification);
        }
    }//End Method


    public function DeleteCategory($id){
        Category::find($id)->delete();
        $notification = array(
            'message' =>'Category deleted successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);

    }// End Method

     ////////////// SubCategory Functions //////////////
    public function AllSubCategory(){
        $subcategory=SubCategory::latest()->get();
        return view('admin.backend.subcategory.all_subcategory',compact('subcategory'));
    }// End Method

    public function AddSubCategory(){
        $category=Category::latest()->get();
        return view('admin.backend.subcategory.add_subcategory',compact('category'));
    }// End Method

    public function StoreSubCategory(Request $request){
        SubCategory::insert([
            'category_id'=>$request->category_id,
            'subcategory_name'=>$request->subcategory_name,
            'subcategory_slug'=>strtolower(str_replace(' ','-',$request->subcategory_name)),

        ]);
        $notification = array(
            'message' =>'SubCategory created successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('all.subcategory')->with($notification);
    }// End Method

    public function EditSubCategory($id){
        $category=Category::latest()->get();
        $subcategory=SubCategory::find($id);
        return view('admin.backend.subcategory.edit_subcategory',compact('category','subcategory'));
    }// End Method

    public function DeleteSubCategory($id){
        SubCategory::find($id)->delete();
        $notification = array(
            'message' =>'SubCategory deleted successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }// End Method
}
