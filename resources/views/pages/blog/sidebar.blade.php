<div class="card">
    <div class="card-content">
        <h3 class="font-18 m-t-0 bold uppercase">Bài viết phổ biến</h3>
        <ul class="collection">
            @foreach($popularposts as $post)
                <li class="collection-item">
                    <a href="{{ route('blog.show',$post->slug) }}" class="teal-text text-darken-4">
                        <span class="truncate tooltipped" data-position="bottom" data-tooltip="{{ $post->title }}">{{ $post->title }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
    
<div class="card">
    <div class="card-content">
        <h3 class="font-18 m-t-0 bold uppercase">Thể loại bài viết</h3>
        <ul>
            @foreach($categories as $category)
                <li class="category-bg-image" style="background-image:url({{asset(Storage::url('category/slider/'.$category->image))}});">

                    <a href="{{ route('blog.categories',$category->slug) }}">

                        <span class="left">{{ $category->name }}</span>

                        <span class="right">{{ $category->posts_count }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="card">
    <div class="card-content">
        <h3 class="font-18 m-t-0 bold uppercase">Tags</h3>
        @foreach($tags as $tag)
            <a href="{{ route('blog.tags',$tag->slug) }}">
                <span class="btn-small teal white-text m-b-5 card-no-shadow">{{ $tag->name }}</span>
            </a>
        @endforeach
    </div>
</div>