@extends('backend.layouts.app')

@section('title', 'Edit Testimonial')

@push('styles')

    
@endpush


@section('content')

    <div class="block-header">
        <a href="{{route('admin.testimonials.index')}}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>Quay lại</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-teal">
                    <h2>Chỉnh sửa phản hồi khách hàng</h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.testimonials.update',$testimonial->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group form-float">
                            <label class="form-label">Tên</label>
                            <div class="form-line">
                                <input type="text" name="name" class="form-control" value="{{$testimonial->name}}">
                            </div>
                        </div>

                        @if(Storage::disk('public')->exists('testimonial/'.$testimonial->image))
                            <div class="form-group">
                                <img src="{{asset(Storage::url('testimonial/'.$testimonial->image))}}" id="testimonial-imgsrc-edit" alt="{{$testimonial->title}}" class="img-responsive img-rounded">
                            </div>
                        @endif
                        <div class="form-group">
                            <input type="file" name="image" id="testimonial-image-input-edit" style="display:none;">
                            <button type="button" class="btn bg-grey btn-sm waves-effect m-t-15" id="testimonial-image-btn-edit">
                                <i class="material-icons">image</i>
                                <span>Ảnh mô tả</span>
                            </button>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nội dung</label>
                            <div class="form-line">
                                <textarea name="testimonial" rows="4" class="form-control no-resize">{{$testimonial->testimonial}}</textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-teal btn-lg m-t-15 waves-effect">
                            <i class="material-icons">update</i>
                            <span>Cập nhật</span>
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')

<script>
    function showImage(fileInput,imgID){
        if (fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
                $(imgID).attr('src',e.target.result);
                $(imgID).attr('alt',fileInput.files[0].name);
            }
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
    $('#testimonial-image-btn-edit').on('click', function(){
        $('#testimonial-image-input-edit').click();
    });
    $('#testimonial-image-input-edit').on('change', function(){
        showImage(this, '#testimonial-imgsrc-edit');
    });
</script>

@endpush
