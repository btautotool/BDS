@extends('frontend.layouts.app')

@section('styles')

@endsection

@section('content')

    <section>
        <div class="container">
            <div class="row">

                <div class="col s12 m12">

                    @if (count($properties) > 0)
                        @foreach($properties as $property)
                            <div class="card horizontal">
                                <div>
                                    <div class="card-content property-content">
                                        @if(Storage::disk('public')->exists('property/'.$property->image) && $property->image)
                                            <div class="card-image blog-content-image">
                                                <img src="{{asset(Storage::url('property/'.$property->image))}}" alt="{{$property->title}}">
                                            </div>
                                        @endif
                                        <span class="card-title search-title" title="{{$property->title}}">
                                            <a href="{{ route('property.show',$property->slug) }}">{{ $property->title }}</a>
                                        </span>
                                        
                                        <div class="address">
                                            <i class="small material-icons left">location_city</i>
                                            <span>{{ ucfirst($property->city) }}</span>
                                        </div>
                                        <div class="address">
                                            <i class="small material-icons left">place</i>
                                            <span>{{ ucfirst($property->address) }}</span>
                                        </div>

                                        <h5>
                                            {{ $property->price }} triệu đồng
                                            <small class="right">{{ $property->purpose == 'sale' ? 'Bán' : 'Cho thuê'}} {{ $property->type == 'house' ? 'Nhà' : 'Căn hộ'}}</small>
                                        </h5>

                                    </div>
                                    <div class="card-action property-action clearfix">
                                        <span class="btn-flat">
                                            <i class="material-icons">check_box</i>
                                            Phòng ngủ: <strong>{{ $property->bedroom}}</strong> 
                                        </span>
                                        <span class="btn-flat">
                                            <i class="material-icons">check_box</i>
                                            Phòng tắm: <strong>{{ $property->bathroom}}</strong> 
                                        </span>
                                        <span class="btn-flat">
                                            <i class="material-icons">check_box</i>
                                            Diện tích: <strong>{{ $property->area}}</strong> mét vuông
                                        </span>
                                        <span class="btn-flat">
                                            <i class="material-icons">comment</i>
                                            {{ $property->comments_count}}
                                        </span>                               
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h4 class="section-heading">Không có tài sản nào được tìm thấy</h4>
                    @endif


                    <div class="m-t-30 m-b-60 center">
                        {{ 
                            $properties->appends([
                                'city'      => Request::get('city'),
                                'type'      => Request::get('type'),
                                'purpose'   => Request::get('purpose'),
                                'bedroom'   => Request::get('bedroom'),
                                'bathroom'  => Request::get('bathroom'),
                                'minprice'  => Request::get('minprice'),
                                'maxprice'  => Request::get('maxprice'),
                                'minarea'   => Request::get('minarea'),
                                'maxarea'   => Request::get('maxarea'),
                                'featured'  => Request::get('featured')
                            ])->links() 
                        }}
                    </div>
        
                </div>

            </div>
        </div>
    </section>

@endsection

@section('scripts')

@endsection