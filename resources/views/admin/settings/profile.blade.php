@extends('backend.layouts.app')

@section('title', 'Profile')

@push('styles')

@endpush


@section('content')

    <div class="block-header"></div>

    <div class="row clearfix">

        <div class="col-xs-12">
            <div class="card">
                <div class="header bg-teal">
                    <h2>
                        Thông tin cá nhân
                    </h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.profile')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="name" class="form-control" value="{{ $profile->name or null }}">
                                <label class="form-label">Tên hiển thị</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="username" class="form-control" value="{{ $profile->username or null }}">
                                <label class="form-label">Tên đăng nhập</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="email" name="email" class="form-control" value="{{ $profile->email or null }}">
                                <label class="form-label">Email</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <label for="image">Ảnh đại diện</label>
                                <input type="file" name="image">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <textarea name="about" rows="4" class="form-control no-resize">{{ $profile->about or null }}</textarea>
                                <label class="form-label">Thông tin về bạn
                        </div>

                        <button type="submit" class="btn btn-teal btn-lg m-t-15 waves-effect">
                            <i class="material-icons">save</i>
                            <span>Lưu thay đổi</span>
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
        $('#profile-image-btn').on('click', function(){
            $('#profile-image-input').click();
        });
        $('#profile-image-input').on('change', function(){
            showImage(this, '#profile-imgsrc');
        });
    })
</script>

@endpush
