<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Mail\Contact;
use App\Message;
use App\Post;
use App\Property;
use App\Rating;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    public function properties()
    {
        $cities = Property::select('city', 'city_slug')->distinct('city_slug')->get();
        $properties = Property::latest()->with('rating')->withCount('comments')->paginate(12);

        return view('pages.properties.property', compact('properties', 'cities'));
    }

    public function propertieshow($slug)
    {
        $property = Property::with('features', 'gallery', 'user', 'comments')
            ->withCount('comments')
            ->where('slug', $slug)
            ->first();
        $property->time = explode('|', $property->time);
        $rating = Rating::where('property_id', $property->id)->where('type', 'property')->avg('rating');

        $relatedproperty = Property::latest()
            ->where('purpose', $property->purpose)
            ->where('type', $property->type)
            ->where('bedroom', $property->bedroom)
            ->where('bathroom', $property->bathroom)
            ->where('id', '!=', $property->id)
            ->take(5)->get();

        $videoembed = $this->convertYoutube($property->video, 560, 315);

        $cities = Property::select('city', 'city_slug')->distinct('city_slug')->get();
        $message = Message::where('property_id', $property->id)->get();
        $timeSelected = [];
        foreach ($message as $item) {
            if (!empty($item->time)) {
                $timeSelected[] = $item->time;
            }
        }
        return view('pages.properties.single', compact('property', 'rating', 'relatedproperty', 'videoembed', 'cities', 'timeSelected'));
    }

    // AGENT PAGE
    public function agents()
    {
        $agents = User::latest()->where('role_id', 2)->paginate(12);

        return view('pages.agents.index', compact('agents'));
    }

    public function agentshow($id)
    {
        $agent = User::findOrFail($id);
        $properties = Property::latest()->where('agent_id', $id)->paginate(10);

        return view('pages.agents.single', compact('agent', 'properties'));
    }

    // BLOG PAGE
    public function blog()
    {
        $month = request('month');
        $year = request('year');

        $posts = Post::latest()->withCount('comments')
            ->when($month, function ($query, $month) {
                return $query->whereMonth('created_at', Carbon::parse($month)->month);
            })
            ->when($year, function ($query, $year) {
                return $query->whereYear('created_at', $year);
            })
            ->where('status', 1)
            ->paginate(10);

        return view('pages.blog.index', compact('posts'));
    }

    public function blogshow($slug)
    {
        $post = Post::with('comments')->withCount('comments')->where('slug', $slug)->first();

        $blogkey = 'blog-' . $post->id;
        if (!Session::has($blogkey)) {
            $post->increment('view_count');
            Session::put($blogkey, 1);
        }

        return view('pages.blog.single', compact('post'));
    }

    // BLOG COMMENT
    public function blogComments(Request $request, $id)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $post = Post::find($id);

        $post->comments()->create(
            [
                'user_id' => Auth::id(),
                'body' => $request->body,
                'parent' => $request->parent,
                'parent_id' => $request->parent_id,
            ]
        );

        return back();
    }

    // BLOG CATEGORIES
    public function blogCategories()
    {
        $posts = Post::latest()->withCount(['comments', 'categories'])
            ->whereHas('categories', function ($query) {
                $query->where('categories.slug', '=', request('slug'));
            })
            ->where('status', 1)
            ->paginate(10);

        return view('pages.blog.index', compact('posts'));
    }

    // BLOG TAGS
    public function blogTags()
    {
        $posts = Post::latest()->withCount('comments')
            ->whereHas('tags', function ($query) {
                $query->where('tags.slug', '=', request('slug'));
            })
            ->where('status', 1)
            ->paginate(10);

        return view('pages.blog.index', compact('posts'));
    }

    // BLOG AUTHOR
    public function blogAuthor()
    {
        $posts = Post::latest()->withCount('comments')
            ->whereHas('user', function ($query) {
                $query->where('username', '=', request('username'));
            })
            ->where('status', 1)
            ->paginate(10);

        return view('pages.blog.index', compact('posts'));
    }

    // MESSAGE TO AGENT (SINGLE AGENT PAGE)
    public function messageAgent(Request $request)
    {
        $request->validate([
            'agent_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
            'time' => 'required',
        ]);

        $agentInfo = User::where('id', $request['agent_id'])->first();
        $name = $agentInfo['name'];
        $message = '<strong>Khách hàng:</strong> ' . $request['name'] 
                    . ' muốn hẹn gặp bạn lúc: '. Carbon::parse($request['time'])->format('H:i d/m/Y') .'. <br/><strong>Số điện thoại:</strong> ' . $request['phone'] 
                    . '. <br/><strong>Email:</strong> ' . $request['email'] 
                    . ' <br/>Hãy chủ động liên hệ sớm nhé!';
        $mailfrom = config('mail.from.address');
        
        Mail::to($agentInfo->email)->send(new Contact($message, $name, $mailfrom));
        Message::create($request->all());

        if ($request->ajax()) {
            return response()->json(['message' => 'Gửi lịch hẹn thành công']);
        }
    }

    // CONATCT PAGE
    public function contact()
    {
        return view('pages.contact');
    }

    public function messageContact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);

        $message = $request->message;
        $mailfrom = $request->email;

        Message::create([
            'agent_id' => 1,
            'name' => $request->name,
            'email' => $mailfrom,
            'phone' => $request->phone,
            'message' => $message,
        ]);

        $adminname = User::find(1)->name;
        $mailto = $request->mailto;

        Mail::to($mailto)->send(new Contact($message, $adminname, $mailfrom));

        if ($request->ajax()) {
            return response()->json(['message' => 'Message send successfully.']);
        }
    }

    public function contactMail(Request $request)
    {
        return $request->all();
    }

    // GALLERY PAGE
    public function gallery()
    {
        $galleries = Gallery::latest()->paginate(12);

        return view('pages.gallery', compact('galleries'));
    }

    // PROPERTY COMMENT
    public function propertyComments(Request $request, $id)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $property = Property::find($id);

        $property->comments()->create(
            [
                'user_id' => Auth::id(),
                'body' => $request->body,
                'parent' => $request->parent,
                'parent_id' => $request->parent_id,
            ]
        );

        return back();
    }

    // PROPERTY RATING
    public function propertyRating(Request $request)
    {
        $rating = $request->input('rating');
        $property_id = $request->input('property_id');
        $user_id = $request->input('user_id');
        $type = 'property';

        $rating = Rating::updateOrCreate(
            ['user_id' => $user_id, 'property_id' => $property_id, 'type' => $type],
            ['rating' => $rating]
        );

        if ($request->ajax()) {
            return response()->json(['rating' => $rating]);
        }
    }

    // PROPERTY CITIES
    public function propertyCities()
    {
        $cities = Property::select('city', 'city_slug')->distinct('city_slug')->get();
        $properties = Property::latest()->with('rating')->withCount('comments')
            ->where('city_slug', request('cityslug'))
            ->paginate(12);

        return view('pages.properties.property', compact('properties', 'cities'));
    }

    // YOUTUBE LINK TO EMBED CODE
    private function convertYoutube($youtubelink, $w = 250, $h = 140)
    {
        return preg_replace(
            "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
            "<iframe width=\"$w\" height=\"$h\" src=\"//www.youtube.com/embed/$2\" frameborder=\"0\" allowfullscreen></iframe>",
            $youtubelink
        );
    }

    public function messageProperty($id)
    {
        $messages = Message::where('property_id', $id)->latest()->paginate(10);
        $property = Property::where('id', $id)->first();
        $property->time = explode('|', $property->time);
        $timeSelected = [];
        foreach ($messages as $item) {
            if (!empty($item->time)) {
                $timeSelected[] = $item->time;
            }
        }

        return view('pages.properties.message', compact('messages', 'property', 'timeSelected'));
    }
}
