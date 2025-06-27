<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Toastr;
use File;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::latest()->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->name);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('category/slider')) {
                Storage::disk('public')->makeDirectory('category/slider');
            }
            // $slider = Image::make($image)->resize(1600, 480)->save();
            // Storage::disk('public')->put('category/slider/' . $imagename, $slider);
            Storage::disk('public')->put('category/slider/' . $imagename, \File::get($image));
            if (config('app.env') == 'test') {
                $full_path_source = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public/category/slider/'. $imagename;
                $full_path_dest = $_SERVER['DOCUMENT_ROOT'].'/public/storage/category/slider/' . $imagename;
                File::copy($full_path_source, $full_path_dest);
            }

            if (!Storage::disk('public')->exists('category/thumb')) {
                Storage::disk('public')->makeDirectory('category/thumb');
            }
            // $thumb = Image::make($image)->resize(500, 330)->save();
            // Storage::disk('public')->put('category/thumb/' . $imagename, $thumb);
            Storage::disk('public')->put('category/thumb/' . $imagename, \File::get($image));
            if (config('app.env') == 'test') {
                $full_path_source = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public/category/thumb/'. $imagename;
                $full_path_dest = $_SERVER['DOCUMENT_ROOT'].'/public/storage/category/thumb/' . $imagename;
                File::copy($full_path_source, $full_path_dest);
            }
        } else {
            $imagename = 'default.png';
        }

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imagename;
        $category->save();

        Toastr::success('message', 'Thêm danh mục thành công');
        return redirect()->route('admin.categories.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'mimes:jpeg,jpg,png',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->name);
        $category = Category::find($id);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('category/slider')) {
                Storage::disk('public')->makeDirectory('category/slider');
            }
            if (Storage::disk('public')->exists('category/slider/' . $category->image)) {
                Storage::disk('public')->delete('category/slider/' . $category->image);
            }
            // $slider = Image::make($image)->resize(1600, 480)->save();
            // Storage::disk('public')->put('category/slider/' . $imagename, $slider);
            Storage::disk('public')->put('category/slider/' . $imagename, \File::get($image));
            if (config('app.env') == 'test') {
                $full_path_source = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public/category/slider/'. $imagename;
                $full_path_dest = $_SERVER['DOCUMENT_ROOT'].'/public/storage/category/slider/' . $imagename;
                File::copy($full_path_source, $full_path_dest);
            }

            if (!Storage::disk('public')->exists('category/thumb')) {
                Storage::disk('public')->makeDirectory('category/thumb');
            }
            if (Storage::disk('public')->exists('category/thumb/' . $category->image)) {
                Storage::disk('public')->delete('category/thumb/' . $category->image);
            }
            // $thumb = Image::make($image)->resize(500, 330)->save();
            // Storage::disk('public')->put('category/thumb/' . $imagename, $thumb);
            Storage::disk('public')->put('category/thumb/' . $imagename, \File::get($image));
            if (config('app.env') == 'test') {
                $full_path_source = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public/category/thumb/'. $imagename;
                $full_path_dest = $_SERVER['DOCUMENT_ROOT'].'/public/storage/category/thumb/' . $imagename;
                File::copy($full_path_source, $full_path_dest);
            }
        } else {
            $imagename = $category->image;
        }

        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imagename;
        $category->save();

        Toastr::success('message', 'Category updated successfully.');
        return redirect()->route('admin.categories.index');
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (Storage::disk('public')->exists('category/slider/' . $category->image)) {
            Storage::disk('public')->delete('category/slider/' . $category->image);
        }

        if (Storage::disk('public')->exists('category/thumb/' . $category->image)) {
            Storage::disk('public')->delete('category/thumb/' . $category->image);
        }

        $category->delete();
        $category->posts()->detach();

        Toastr::success('message', 'Category deleted successfully.');
        return back();
    }
}
