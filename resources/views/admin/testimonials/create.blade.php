@extends('backend.layouts.app')

@section('title', 'Create Testimonial')

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
                    <h2>Tạo phản hồi của khách hàng</h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.testimonials.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="name" class="form-control">
                                <label class="form-label">Tên</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <textarea name="testimonial" rows="4" class="form-control no-resize"></textarea>
                                <label class="form-label">Nội dung</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <img src="" id="testimonial-imgsrc" class="img-responsive">
                            <input type="file" name="image" id="testimonial-image-input" style="display:none;">
                            <button type="button" class="btn bg-grey btn-sm waves-effect m-t-15" id="testimonial-image-btn">
                                <i class="material-icons">image</i>
                                <span>Ảnh mô tả</span>
                            </button>
                        </div>

                        <button type="submit" class="btn btn-teal btn-lg m-t-15 waves-effect">
                            <i class="material-icons">save</i>
                            <span>Lưu</span>
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')

<script>
    $(function(){
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
        $('#testimonial-image-btn').on('click', function(){
            $('#testimonial-image-input').click();
        });
        $('#testimonial-image-input').on('change', function(){
            showImage(this, '#testimonial-imgsrc');
        });
    })
</script>

@endpush
