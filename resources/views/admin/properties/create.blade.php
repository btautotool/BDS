@extends('backend.layouts.app')

@section('title', 'Create Property')

@push('styles')

    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

@endpush


@section('content')

    <div class="block-header"></div>

    <div class="row clearfix">
        <form action="{{route('admin.properties.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-teal">
                    <h2>Tạo tài sản</h2>
                </div>
                <div class="body">

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" name="title" class="form-control" value="{{old('title')}}">
                            <label class="form-label">Tên tài sản</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="price" required>
                            <label class="form-label">Giá</label>
                        </div>
                        <div class="help-info">Triệu đồng</div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="bedroom" required>
                            <label class="form-label">Số phòng ngủ</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="bathroom" required>
                            <label class="form-label">Số phòng tắm</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="city" required>
                            <label class="form-label">Tỉnh</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="address" required>
                            <label class="form-label">Địa chỉ cụ thể</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="area" required>
                            <label class="form-label">Diện tích</label>
                        </div>
                        <div class="help-info">mét vuông</div>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" id="featured" name="featured" class="filled-in" value="1" />
                        <label for="featured">Tính năng đặc biệt</label>
                    </div>

                    <hr>
                    <div class="form-group">
                        <label for="tinymce">Mô tả</label>
                        <textarea name="description" id="tinymce">{{old('description')}}</textarea>
                    </div>

                    <hr>
                    <div class="form-group">
                        <label for="tinymce-nearby">Gần với khu vực</label>
                        <textarea name="nearby" id="tinymce-nearby">{{old('nearby')}}</textarea>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="header bg-teal">
                    <h2>Thư viện ảnh</h2>
                </div>
                <div class="body">
                    <input id="input-id" type="file" name="gallaryimage[]" class="file" data-preview-file-type="text" multiple>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-teal">
                    <h2>Lựa chọn</h2>
                </div>
                <div class="body">

                    <div class="form-group form-float">
                        <div class="form-line {{$errors->has('purpose') ? 'focused error' : ''}}">
                            <label>Kiểu tài sản</label>
                            <select name="purpose" class="form-control show-tick">
                                <option value="">-- Chọn một --</option>
                                <option value="sale">Bán</option>
                                <option value="rent">Cho thuê</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line {{$errors->has('type') ? 'focused error' : ''}}">
                            <label>Loại tài sản</label>
                            <select name="type" class="form-control show-tick">
                                <option value="">-- Chọn một --</option>
                                <option value="house">Nhà</option>
                                <option value="apartment">Căn hộ</option>
                            </select>
                        </div>
                    </div>

                    <h5>Tính năng khác</h5>
                    <div class="form-group demo-checkbox">
                        @foreach($features as $feature)
                            <input type="checkbox" id="features-{{$feature->id}}" name="features[]" class="filled-in chk-col-teal" value="{{$feature->id}}" />
                            <label for="features-{{$feature->id}}">{{$feature->name}}</label>
                        @endforeach
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="video">
                            <label class="form-label">Link video</label>
                        </div>
                        <div class="help-info">Youtube Link</div>
                    </div>

                    <div class="clearfix">
                        <h5>Google Map</h5>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="location_latitude" class="form-control" required/>
                                <label class="form-label">Vĩ độ</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="location_longitude" class="form-control" required/>
                                <label class="form-label">Kinh độ</label>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="card">
                <div class="header bg-teal">
                    <h2>Chọn thời gian rảnh</h2>
                </div>
                <div class="body" id="time_free">
                    <div class="form-group">
                        <button type="button" id="add-time" class="btn btn-teal btn-lg m-t-15 waves-effect">
                            <i class="material-icons left">add</i>
                            <span>Thêm</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="header bg-teal">
                    <h2>Sơ đồ mặt bằng</h2>
                </div>
                <div class="body">
                    <div class="form-group">
                        <input type="file" name="floor_plan">
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="header bg-teal">
                    <h2>Ảnh mô tả</h2>
                </div>
                <div class="body">
                    <div class="form-group">
                        <input type="file" name="image">
                    </div>

                    {{-- BUTTON --}}
                    <a href="{{route('admin.properties.index')}}" class="btn btn-danger btn-lg m-t-15 waves-effect">
                        <i class="material-icons left">arrow_back</i>
                        <span>Quay lại</span>
                    </a>

                    <button type="submit" class="btn btn-teal btn-lg m-t-15 waves-effect">
                        <i class="material-icons">save</i>
                        <span>Lưu</span>
                    </button>
                </div>
            </div>
        </div>
        </form>
    </div>

@endsection


@push('scripts')
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/fileinput.min.js"></script>

    <script src="{{ asset('backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script src="{{asset('backend/plugins/tinymce/tinymce.js')}}"></script>
    <script>
        $(function () {
            $("#input-id").fileinput();
        });

        $(function () {
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{asset('backend/plugins/tinymce')}}';
        });

        $(function () {
            tinymce.init({
                selector: "textarea#tinymce-nearby",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: '',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{asset('backend/plugins/tinymce')}}';
        });

        const btnAddTime = document.getElementById('add-time');
        const timeFreeContainer = document.getElementById('time_free');
        btnAddTime.addEventListener('click', function() {
            timeFreeContainer.insertAdjacentHTML('beforeend', `<div class="form-group">
                <input type="datetime-local" name="time[]" min="{{ date('Y-m-d\TH:i') }}">
                <button type="button" class="btn btn-danger btn-sm waves-effect" onclick="this.parentElement.remove()">
                    <i class="material-icons">delete</i>
                </button>
            </div>`);
        })
    </script>

@endpush
