<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use App\Gallery;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Toastr;
use File;

class GalleryController extends Controller
{

    public function album()
    {
        $albums = Album::latest()->with('galleryimages')->get(); //return $albums;

        return view('admin.galleries.album', compact('albums'));
    }

    public function albumStore(Request $request)
    {
        Album::create([
            'name' => $request->name,
            'user_id' => \Auth::id(),
        ]);
        return back();
    }

    public function albumGallery($id)
    {
        $album_id = $id;

        $galleries = Gallery::latest()->where('album_id', $album_id)->get();

        return view('admin.galleries.gallery', compact('galleries', 'album_id'));
    }

    public function Gallerystore(Request $request)
    {
        $albumid = $request->input('albumid');

        $image = $request->file('file');

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = 'gallery-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagesize = $image->getClientSize();
            $imagetype = $image->getClientMimeType();

            if (!Storage::disk('public')->exists('gallery')) {
                Storage::disk('public')->makeDirectory('gallery');
            }
            // $imagegallery = Image::make($image)->save();
            // Storage::disk('public')->put('gallery/' . $imagename, $imagegallery);
            Storage::disk('public')->put('gallery/' . $imagename, \File::get($image));
            if (config('app.env') == 'test') {
                $full_path_source = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public/gallery/'. $imagename;
                $full_path_dest = $_SERVER['DOCUMENT_ROOT'].'/public/storage/gallery/' . $imagename;
                File::copy($full_path_source, $full_path_dest);
            }

            $imagelink = Storage::url($imagename);

            Gallery::create([
                'album_id' => $albumid,
                'image' => $imagename,
                'size' => $imagesize,
                'type' => $imagetype,
                'link' => $imagelink,
            ]);
        }

        Toastr::success('message', 'Images uploaded successfully.');

        return back();
    }

}
