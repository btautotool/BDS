<section class="carousel carousel-slider center">
    @if($sliders)
        @foreach($sliders as $slider)
            <div class="carousel-item" style="background-image: url({{asset(Storage::url('slider/'.$slider->image))}}); background-repeat: round;" href="#{{$slider->id}}!">
                <div class="slider-content">
                    <h2 class="white-text">{{ $slider->title }}</h2>
                    <p class="white-text">{{ $slider->description }}</p>
                </div>
            </div>
        @endforeach
    @else 
        <div class="carousel-item amber teal-text" style="background-image: url({{ asset('frontend/images/real_estate.jpg') }})" href="#1!">
            <h2>Tiêu đề</h2>
            <p class="teal-text">Mô tả</p>
        </div>
    @endif
</section>