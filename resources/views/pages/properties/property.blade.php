@extends('frontend.layouts.app')

@section('styles')

@endsection

@section('content')

    <section class="section">
        <div class="container">
            
            <div class="row">
                <h4 class="section-heading">Tài sản</h4>
            </div>

            <div class="row">
                <div class="city-categories">
                    @foreach($cities as $city)
                        <div class="col s12 m3">
                            <a href="{{ route('property.city',$city->city_slug) }}">
                                <div class="city-category">
                                    <span>{{ $city->city }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
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
                                    <a class="btn-floating halfway-fab waves-effect waves-light teal"><i class="small material-icons">star</i></a>
                                @endif
                            </div>
                            <div class="card-content property-content">
                                <a href="{{ route('property.show',$property->slug) }}">
                                    <span class="card-title tooltipped" data-position="bottom" data-tooltip="{{ $property->title }}">{{ str_limit( $property->title, 18 ) }}</span>
                                </a>

                                <div class="address">
                                    <i class="small material-icons left">place</i>
                                    <span>{{ ucfirst($property->city) }}</span>
                                </div>
                                <div class="address">
                                    <i class="small material-icons left">language</i>
                                    <span>{{ ucfirst($property->address) }}</span>
                                </div>

                                <div class="address">
                                    <i class="small material-icons left">check_box</i>
                                    <span>{{ $property->type == 'sale' ? 'Bán' : 'Cho thuê' }}</span>
                                </div>
                                <div class="address">
                                    <i class="small material-icons left">check_box</i>
                                    <span>{{ $property->purpose == 'house' ? 'Nhà' : 'Căn hộ' }}</span>
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
                                    <strong>{{ $property->comments_count}}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="m-t-30 m-b-60 center">
                {{ $properties->links() }}
            </div>

        </div>
    </section>

@endsection

@section('scripts')

<script>

    $(function(){
        var js_properties = <?php echo json_encode($properties);?>;
        js_properties.data.forEach(element => {
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