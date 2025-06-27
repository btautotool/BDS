<?php

namespace App\Http\Controllers\Agent;

use App\Feature;
use App\Http\Controllers\Controller;
use App\Property;
use App\PropertyImageGallery;
use Auth;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Toastr;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::latest()
            ->withCount('comments')
            ->where('agent_id', Auth::id())
            ->paginate(10);

        return view('agent.properties.index', compact('properties'));
    }

    public function create()
    {
        $features = Feature::all();

        return view('agent.properties.create', compact('features'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:properties|max:255',
            'price' => 'required',
            'purpose' => 'required',
            'type' => 'required',
            'bedroom' => 'required',
            'bathroom' => 'required',
            'city' => 'required',
            'address' => 'required',
            'area' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png',
            'floor_plan' => 'image|mimes:jpeg,jpg,png',
            'description' => 'required',
            'location_latitude' => 'required',
            'location_longitude' => 'required',
            'time' => 'required',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('property')) {
                Storage::disk('public')->makeDirectory('property');
            }
            // $propertyimage = Image::make($image)->save();
            // Storage::disk('public')->put('property/' . $imagename, $propertyimage);
            Storage::disk('public')->put('property/' . $imagename, \File::get($image));
            if (config('app.env') == 'test') {
                $full_path_source = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public/property/'. $imagename;
                $full_path_dest = $_SERVER['DOCUMENT_ROOT'].'/public/storage/property/' . $imagename;
                File::copy($full_path_source, $full_path_dest);
            }
        }

        $floor_plan = $request->file('floor_plan');
        if (isset($floor_plan)) {
            $currentDate = Carbon::now()->toDateString();
            $imagefloorplan = 'floor-plan-' . $currentDate . '-' . uniqid() . '.' . $floor_plan->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('property')) {
                Storage::disk('public')->makeDirectory('property');
            }
            // $propertyfloorplan = Image::make($floor_plan)->save();
            // Storage::disk('public')->put('property/' . $imagefloorplan, $propertyfloorplan);
            Storage::disk('public')->put('property/' . $imagefloorplan, \File::get($floor_plan));
            if (config('app.env') == 'test') {
                $full_path_source = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public/property/'. $imagefloorplan;
                $full_path_dest = $_SERVER['DOCUMENT_ROOT'].'/public/storage/property/' . $imagefloorplan;
                File::copy($full_path_source, $full_path_dest);
            }
        } else {
            $imagefloorplan = 'default.png';
        }

        $property = new Property();
        $property->title = $request->title;
        $property->slug = $slug;
        $property->price = $request->price;
        $property->purpose = $request->purpose;
        $property->type = $request->type;
        $property->image = $imagename;
        $property->bedroom = $request->bedroom;
        $property->bathroom = $request->bathroom;
        $property->city = $request->city;
        $property->city_slug = str_slug($request->city);
        $property->address = $request->address;
        $property->area = $request->area;

        if (isset($request->featured)) {
            $property->featured = true;
        }
        $property->agent_id = Auth::id();
        $property->video = $request->video;
        $property->floor_plan = $imagefloorplan;
        $property->description = $request->description;
        $property->location_latitude = $request->location_latitude;
        $property->location_longitude = $request->location_longitude;
        $property->nearby = $request->nearby;
        $property->time = is_array($request->time) ? implode('|', $request->time) : $request->time;
        $property->save();

        $property->features()->attach($request->features);

        $gallary = $request->file('gallaryimage');

        if ($gallary) {
            foreach ($gallary as $images) {
                $currentDate = Carbon::now()->toDateString();
                $galimage['name'] = 'gallary-' . $currentDate . '-' . uniqid() . '.' . $images->getClientOriginalExtension();
                $galimage['size'] = $images->getClientSize();
                $galimage['property_id'] = $property->id;

                if (!Storage::disk('public')->exists('property/gallery')) {
                    Storage::disk('public')->makeDirectory('property/gallery');
                }
                // $propertyimage = Image::make($images)->save();
                // Storage::disk('public')->put('property/gallery/' . $galimage['name'], $propertyimage);
                Storage::disk('public')->put('property/gallery/' . $galimage['name'], \File::get($images));
                if (config('app.env') == 'test') {
                    $full_path_source = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public/property/gallery/'. $galimage['name'];
                    $full_path_dest = $_SERVER['DOCUMENT_ROOT'].'/public/storage/property/gallery/' . $galimage['name'];
                    File::copy($full_path_source, $full_path_dest);
                }
                $property->gallery()->create($galimage);
            }
        }

        Toastr::success('message', 'Property created successfully.');
        return redirect()->route('agent.properties.index');
    }

    public function edit(Property $property)
    {
        $features = Feature::all();
        $property = Property::where('slug', $property->slug)->first();
        $property->time = explode('|', $property->time);

        return view('agent.properties.edit', compact('property', 'features'));
    }

    public function update(Request $request, $property)
    {
        $request->validate([
            'title' => 'required|max:255',
            'price' => 'required',
            'purpose' => 'required',
            'type' => 'required',
            'bedroom' => 'required',
            'bathroom' => 'required',
            'city' => 'required',
            'address' => 'required',
            'area' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png',
            'floor_plan' => 'image|mimes:jpeg,jpg,png',
            'description' => 'required',
            'location_latitude' => 'required',
            'location_longitude' => 'required',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);

        $property = Property::find($property->id);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('property')) {
                Storage::disk('public')->makeDirectory('property');
            }
            if (Storage::disk('public')->exists('property/' . $property->image)) {
                Storage::disk('public')->delete('property/' . $property->image);
            }
            $propertyimage = Image::make($image)->save();
            Storage::disk('public')->put('property/' . $imagename, $propertyimage);
            if (config('app.env') == 'test') {
                $full_path_source = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public/property/'. $imagename;
                $full_path_dest = $_SERVER['DOCUMENT_ROOT'].'/public/storage/property/' . $imagename;
                File::copy($full_path_source, $full_path_dest);
            }
        } else {
            $imagename = $property->image;
        }

        $floor_plan = $request->file('floor_plan');
        if (isset($floor_plan)) {
            $currentDate = Carbon::now()->toDateString();
            $imagefloorplan = 'floor-plan-' . $currentDate . '-' . uniqid() . '.' . $floor_plan->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('property')) {
                Storage::disk('public')->makeDirectory('property');
            }
            if (Storage::disk('public')->exists('property/' . $property->floor_plan)) {
                Storage::disk('public')->delete('property/' . $property->floor_plan);
            }

            $propertyfloorplan = Image::make($floor_plan)->save();
            Storage::disk('public')->put('property/' . $imagefloorplan, $propertyfloorplan);
            $full_path_source = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public/property/'. $imagefloorplan;
            $full_path_dest = $_SERVER['DOCUMENT_ROOT'].'/public/storage/property/' . $imagefloorplan;
            File::copy($full_path_source, $full_path_dest);
        } else {
            $imagefloorplan = $property->floor_plan;
        }

        $property->title = $request->title;
        $property->slug = $slug;
        $property->price = $request->price;
        $property->purpose = $request->purpose;
        $property->type = $request->type;
        $property->image = $imagename;
        $property->bedroom = $request->bedroom;
        $property->bathroom = $request->bathroom;
        $property->city = $request->city;
        $property->city_slug = str_slug($request->city);
        $property->address = $request->address;
        $property->area = $request->area;

        if (isset($request->featured)) {
            $property->featured = true;
        } else {
            $property->featured = false;
        }

        $property->description = $request->description;
        $property->video = $request->video;
        $property->floor_plan = $imagefloorplan;
        $property->location_latitude = $request->location_latitude;
        $property->location_longitude = $request->location_longitude;
        $property->nearby = $request->nearby;
        $property->time = is_array($request->time) ? implode('|', $request->time) : $request->time;dd($property);
        $property->save();

        $property->features()->sync($request->features);

        $gallary = $request->file('gallaryimage');
        if ($gallary) {
            foreach ($gallary as $images) {
                if (isset($images)) {
                    $currentDate = Carbon::now()->toDateString();
                    $galimage['name'] = 'gallary-' . $currentDate . '-' . uniqid() . '.' . $images->getClientOriginalExtension();
                    $galimage['size'] = $images->getClientSize();
                    $galimage['property_id'] = $property->id;

                    if (!Storage::disk('public')->exists('property/gallery')) {
                        Storage::disk('public')->makeDirectory('property/gallery');
                    }
                    // $propertyimage = Image::make($images)->save();
                    // Storage::disk('public')->put('property/gallery/' . $galimage['name'], $propertyimage);
                    Storage::disk('public')->put('property/gallery/' . $galimage['name'], \File::get($images));
                    if (config('app.env') == 'test') {
                        $full_path_source = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public/property/gallery/'. $galimage['name'];
                        $full_path_dest = $_SERVER['DOCUMENT_ROOT'].'/public/storage/property/gallery/' . $galimage['name'];
                        File::copy($full_path_source, $full_path_dest);
                    }

                    $property->gallery()->create($galimage);
                }
            }
        }

        Toastr::success('message', 'Property updated successfully.');
        return redirect()->route('agent.properties.index');
    }

    public function destroy(Property $property)
    {
        $property = Property::find($property->id);

        if (Storage::disk('public')->exists('property/' . $property->image)) {
            Storage::disk('public')->delete('property/' . $property->image);
        }
        if (Storage::disk('public')->exists('property/' . $property->floor_plan)) {
            Storage::disk('public')->delete('property/' . $property->floor_plan);
        }

        $property->delete();

        $galleries = $property->gallery;
        if ($galleries) {
            foreach ($galleries as $key => $gallery) {
                if (Storage::disk('public')->exists('property/gallery/' . $gallery->name)) {
                    Storage::disk('public')->delete('property/gallery/' . $gallery->name);
                }
                PropertyImageGallery::destroy($gallery->id);
            }
        }

        $property->features()->detach();

        Toastr::success('message', 'Property deleted successfully.');
        return back();
    }

    // DELETE GALERY IMAGE ON EDIT
    public function galleryImageDelete(Request $request)
    {

        $gallaryimg = PropertyImageGallery::find($request->id)->delete();

        if (Storage::disk('public')->exists('property/gallery/' . $request->image)) {
            Storage::disk('public')->delete('property/gallery/' . $request->image);
        }

        if ($request->ajax()) {
            return response()->json(['msg' => true]);
        }
    }
}
