<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;


class SubCategoryController extends Controller
{
    //
    public function index()
    {
        $brand = Brand::all();
        $category = Category::all();
        $sub_category = SubCategory::orderBy('id', 'DESC')->get();
        return view('backend.subcategory.index', compact('sub_category', 'brand', 'category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_id' => 'required',
            'category_id' => 'required',
            'subcategory_name' => 'required',

        ]);

        $name_slug = Str::of($request->subcategory_name)->slug('-');

        if ($request->file('image')) {

            $img = $request->file('image');
            $name_gen = $name_slug . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(240, 120)->save("image/subcategory/" . $name_gen);
            $img_url = "image/subcategory/" . $name_gen;

            SubCategory::insert([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_name' => $request->subcategory_name,
                'subcategory_slug' => $name_slug,
                'image' => $img_url,
                'subcategory_status' => $request->subcategory_status,
                'created_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'SubCategory Added Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        } else {
            SubCategory::insert([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_name' => $request->subcategory_name,
                'subcategory_slug' => $name_slug,
                'subcategory_status' => $request->subcategory_status,
                'created_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'SubCategory Added Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }

    public function edit($id)
    {
        $brand = Brand::all();
        $category = Category::all();
        $edit = SubCategory::find($id);

        return view('backend.subcategory.edit', compact('brand', 'category', 'edit'));
    }

    public function update(Request $request)
    {
        $update = $request->id;

        SubCategory::findOrFail($update)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => Str::of($request->subcategory_name)->slug('-'),
            'updated_at' => Carbon::now(),
        ]);
        $notification = array('messege' => 'SubCategory Added Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {

        SubCategory::findOrFail($id)->delete();

        $notification = array('messege' => 'SubCategory Delete Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
