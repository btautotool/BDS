<?php

namespace App\Http\Controllers;

use App\Post;
use App\Property;
use App\Slider;
use App\Testimonial;
use Illuminate\Http\Request;

class FrontpageController extends Controller
{

    public function index()
    {
        $sliders = Slider::latest()->get();
        $properties = Property::latest()->where('active', 1)->with('rating')->withCount('comments')->take(6)->get();
        $testimonials = Testimonial::latest()->get();
        $posts = Post::latest()->where('status', 1)->take(6)->get();

        return view('frontend.index', compact('sliders', 'properties', 'testimonials', 'posts'));
    }

    public function search(Request $request)
    {
        $city = strtolower($request->city);
        $citySearch = strtolower($request->city);
        $type = $request->type;
        $typeSearch = $request->type;
        $purpose = $request->purpose;
        $purposeSearch = $request->purpose;
        $bedroom = $request->bedroom;
        $bedroomNumber = $request->bedroom;
        $bathroom = $request->bathroom;
        $bathroomNumber = $request->bathroom;
        $minprice = $request->minprice;
        $maxprice = $request->maxprice;
        $minarea = $request->minarea;
        $maxarea = $request->maxarea;
        $featured = $request->featured;

        $properties = Property::latest()->withCount('comments')
            ->when($city, function ($query, $city) {
                return $query->where('city', '=', $city);
            })
            ->when($type, function ($query, $type) {
                return $query->where('type', '=', $type);
            })
            ->when($purpose, function ($query, $purpose) {
                return $query->where('purpose', '=', $purpose);
            })
            ->when($bedroom, function ($query, $bedroom) {
                return $query->where('bedroom', '=', $bedroom);
            })
            ->when($bathroom, function ($query, $bathroom) {
                return $query->where('bathroom', '=', $bathroom);
            })
            ->when($minprice, function ($query, $minprice) {
                return $query->where('price', '>=', $minprice);
            })
            ->when($maxprice, function ($query, $maxprice) {
                return $query->where('price', '<=', $maxprice);
            })
            ->when($minarea, function ($query, $minarea) {
                return $query->where('area', '>=', $minarea);
            })
            ->when($maxarea, function ($query, $maxarea) {
                return $query->where('area', '<=', $maxarea);
            })
            ->when($featured, function ($query, $featured) {
                return $query->where('featured', '=', 1);
            })
            ->paginate(10);
        return view('pages.search', compact([
            'properties',
            'citySearch',
            'typeSearch',
            'purposeSearch',
            'bedroomNumber',
            'bathroomNumber',
            'maxarea',
            'featured',
        ]));
    }

}
