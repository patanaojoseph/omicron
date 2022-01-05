<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function AllCat(){
        $categories = Category::latest()->paginate(12);
        $trashCat = Category::onlyTrashed()->latest()->paginate(12);
        return view('admin.category.index',compact('categories','trashCat'));
    }

    public function AddCat(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        [
            'category_name.required' => 'Please input a Category name'
        ]);
        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->back()->with('success','New Category was added successfully.');
    }

    public function EditCat($id){
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    public function UpdateCat(Request $request, $id){
        Category::find($id)->update([
            'category_name' => $request->category_name,
            'updated_at' => Carbon::now()
        ]);
        return Redirect()->route('all.category')->with('success','Category was updated successfully.');
    }

    public function DelCat($id){
        Category::find($id)->delete();
        return Redirect()->back()->with('success','Category was move to Trash Categories.');
    }

    public function RestoreCat($id){
        Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Category was successfully restored.');
    }

    public function RemoveCat($id){
        Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success','Category was completely remove!');
    }

    public function AllBrand(){
        $brands = Brand::latest()->get();
        return view('admin.brand.index',compact('brands'));
    }

    public function AddBrand(Request $request){
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|max:255',
            'brand_image' => 'required|mimes:jpeg,jpg,png',
        ],
        [
            'brand_name.required' => 'Brand name is required.',
            'brand_name.min' => 'Brand image must be jpeg, jpg or png file.',
        ]);
        $brand_image = $request->file('brand_image');

        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $file_location = 'images/brands/';
        $last_img = $file_location.$img_name;
        $brand_image->move($file_location,$img_name);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->back()->with('success',' New Brand was successfully added.');

    }

    public function EditBrand($id){
        $brands = Brand::find($id);
        return view('admin.brand.edit',compact('brands'));
    }

    public function UpdateBrand(Request $request, $id){
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|max:255',
        ],
        [
            'brand_name.required' => 'Brand name is required.',
            'brand_name.min' => 'Brand image must be jpeg, jpg or png file.',
        ]);
        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');

        if($brand_image){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $file_location = 'images/brands/';
            $last_img = $file_location.$img_name;
            $brand_image->move($file_location,$img_name);

            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'updated_at' => Carbon::now()
            ]);
            return Redirect()->route('all.brand')->with('success',' Brand was updated successfully.');
        }else{
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'updated_at' => Carbon::now()
            ]);
            return Redirect()->route('all.brand')->with('success',' Brand was updated successfully.');
        }
    }

    public function DeleteBrand($id){
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        return Redirect()->back()->with('success','Brand was deleted successfully.');
    }
}
