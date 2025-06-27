@extends('backend.layouts.app')

@section('title', 'Create User')

@push('styles')
<link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">

    
@endpush


@section('content')

    <div class="block-header">
        <a href="{{route('admin.user-manager.index')}}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>Quay lại</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-teal">
                    <h2>Tên người dùng</h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.user-manager.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="name" class="form-control">
                                <label class="form-label">Họ và tên</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="email" class="form-control">
                                <label class="form-label">Email</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="password" name="password" class="form-control">
                                <label class="form-label">Mật khẩu</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="password" name="password_confirmation" class="form-control">
                                <label class="form-label">Nhập lại Mật khẩu</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label>Chọn quyền</label>
                                <select name="role_id"" class="form-control show-tick">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
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
<script src="{{ asset('backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
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
