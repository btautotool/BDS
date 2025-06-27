@extends('frontend.layouts.app')

@section('content')
    <!-- FEATURED SECTION -->

    <section class="section">
        <div class="container">
            <div class="row">
                <h4 class="section-heading">Danh sách tài sản</h4>
            </div>
            <div class="row">

                @foreach($properties as $property)
                    <div class="col s12 m4">
                        <div class="card">
                            <div class="card-image">
                                @if(Storage::disk('public')->exists('property/'.$property->image) && $property->image)
                                    <span class="card-image-bg" style="background-image:url({{asset(Storage::url('property/'.$property->image))}});"></span>
                                @else
                                    <span class="card-image-bg"><span>
                                @endif
                                @if($property->featured == 1)
                                    <a class="btn-floating halfway-fab waves-effect waves-light teal" title="Featured"><i class="small material-icons">star</i></a>
                                @endif
                            </div>
                            <div class="card-content property-content">
                                <a href="{{ route('property.show',$property->slug) }}">
                                    <span class="card-title tooltipped" data-position="bottom" data-tooltip="{{ $property->title }}">{{ str_limit( $property->title, 18 ) }}</span>
                                </a>

                                <div class="address">
                                    <i class="small material-icons left">location_city</i>
                                    <span>{{ ucfirst($property->city) }}</span>
                                </div>
                                <div class="address">
                                    <i class="small material-icons left">place</i>
                                    <span>{{ ucfirst($property->address) }}</span>
                                </div>
                                <div class="address">
                                    <i class="small material-icons left">check_box</i>
                                    <span>{{ $property->purpose == 'sale' ? 'Bán' : 'Cho thuê' }} {{ ucfirst($property->type == 'house' ? 'Nhà' : 'Căn hộ') }}</span>
                                </div>

                                <h5>
                                    {{ $property->price }} triệu đồng
                                </h5>
                            </div>
                            <div class="card-action property-action">
                                <span class="btn-flat">
                                    <i class="material-icons">check_box</i>
                                    Phòng ngủ: <strong>{{ $property->bedroom}}</strong> 
                                </span>
                                </br>
                                <span class="btn-flat">
                                    <i class="material-icons">check_box</i>
                                    Phòng tắm: <strong>{{ $property->bathroom}}</strong> 
                                </span>
                                </br>
                                <span class="btn-flat">
                                    <i class="material-icons">check_box</i>
                                    Diện tích: <strong>{{ $property->area}}</strong> mét vuông
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>


    <!-- TESTIMONIALS SECTION -->

    <section class="section grey lighten-3 center">
        <div class="container">

            <h4 class="section-heading">Ý kiến khách hàng</h4>

            <div class="carousel testimonials">

                @foreach($testimonials as $testimonial)
                    <div class="carousel-item testimonial-item" href="#{{$testimonial->id}}!">
                        <div class="card testimonial-card">
                            <span style="height:20px;display:block;"></span>
                            <div class="card-image testimonial-image">
                                <img src="{{asset(Storage::url('testimonial/'.$testimonial->image))}}">
                            </div>
                            <div class="card-content">
                                <span class="card-title">{{$testimonial->name}}</span>
                                <p>
                                    {{$testimonial->testimonial}}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>

    </section>


    <!-- BLOG SECTION -->

    <section class="section center">
        <div class="row">
            <h4 class="section-heading">Tin tức</h4>
        </div>
        <div class="container">
            <div class="row">

                @foreach($posts as $post)
                <div class="col s12 m4">
                    <div class="card">
                        <div class="card-image">
                            @if(Storage::disk('public')->exists('posts/'.$post->image) && $post->image)
                                <span class="card-image-bg" style="background-image:url({{asset(Storage::url('posts/'.$post->image))}});"></span>
                            @endif
                        </div>
                        <div class="card-content">
                            <span class="card-title tooltipped" data-position="bottom" data-tooltip="{{$post->title}}">
                                <a href="{{ route('blog.show',$post->slug) }}">{{ str_limit($post->title,120) }}</a>
                            </span>
                        </div>
                        <div class="card-action blog-action">
                            <a href="{{ route('blog.author',$post->user->username) }}" class="btn-flat">
                                <i class="material-icons">person</i>
                                <span>{{$post->user->name}}</span>
                            </a>
                            @foreach($post->categories as $key => $category)
                                <a href="{{ route('blog.categories',$category->slug) }}" class="btn-flat">
                                    <i class="material-icons">folder</i>
                                    <span>{{$category->name}}</span>
                                </a>
                            @endforeach
                            <a href="#" class="btn-flat disabled">
                                <i class="material-icons">watch_later</i>
                                <span>{{$post->created_at->diffForHumans()}}</span>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>
    $(function(){
        var js_properties = <?php echo json_encode($properties);?>;
        js_properties.forEach(element => {
            if(element.rating){
                var elmt = element.rating;
                var sum = 0;
                for( var i = 0; i < elmt.length; i++ ){
                    sum += parseFloat( elmt[i].rating ); 
                }
                var avg = sum/elmt.length;
                if(isNaN(avg) == false){
                    $("#propertyrating-"+element.id).rateYo({
                        rating: avg,
                        starWidth: "20px",
                        readOnly: true
                    });
                }else{
                    $("#propertyrating-"+element.id).rateYo({
                        rating: 0,
                        starWidth: "20px",
                        readOnly: true
                    });
                }
            }
        });
    })
</script>
@endsection