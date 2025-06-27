@extends('backend.layouts.app')

@section('title', 'Edit Property')

@push('styles')

    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

@endpush


@section('content')

    <div class="block-header"></div>

    <div class="row clearfix">
        <form action="{{route('admin.properties.update',$property->slug)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-teal">
                    <h2>Sửa tài sản</h2>
                </div>
                <div class="body">

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" name="title" class="form-control" value="{{$property->title}}">
                            <label class="form-label">Tên tài sản</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" name="price" class="form-control" value="{{$property->price}}" required>
                            <label class="form-label">Giá</label>
                        </div>
                        <div class="help-info">Triệu đồng</div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="bedroom" value="{{$property->bedroom}}" required>
                            <label class="form-label">Số phòng ngủ</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="bathroom" value="{{$property->bathroom}}" required>
                            <label class="form-label">Số phòng tắm</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="city" value="{{$property->city}}" required>
                            <label class="form-label">Thành phố</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="address" value="{{$property->address}}" required>
                            <label class="form-label">Địa chỉ</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="area" value="{{$property->area}}" required>
                            <label class="form-label">Diện tích</label>
                        </div>
                        <div class="help-info">m2</div>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" id="featured" name="featured" class="filled-in" value="1" {{ $property->featured ? 'checked' : '' }}/>
                        <label for="featured">Tính năng đặc biệt</label>
                    </div>

                    <hr>
                    <div class="form-group">
                        <label for="tinymce">Mô tả</label>
                        <textarea name="description" id="tinymce">{{$property->description}}</textarea>
                    </div>

                    <hr>
                    <div class="form-group">
                        <label for="tinymce-nearby">Gần với khu vực</label>
                        <textarea name="nearby" id="tinymce-nearby">{{$property->nearby}}</textarea>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="header bg-teal">
                    <h2>Thư viện ảnh</h2>
                </div>
                <div class="body">
                    <div class="gallery-box" id="gallerybox">
                        @foreach($property->gallery as $gallery)
                        <div class="gallery-image-edit" id="gallery-{{$gallery->id}}">
                            <button type="button" data-id="{{$gallery->id}}" class="btn btn-danger btn-sm"><i class="material-icons">delete_forever</i></button>
                            <img class="img-responsive" src="{{asset(Storage::url('property/gallery/'.$gallery->name))}}" alt="{{$gallery->name}}">
                        </div>
                        @endforeach
                    </div>
                    <div class="gallery-box">
                        <hr>
                        <input type="file" name="gallaryimage[]" value="UPLOAD" id="gallaryimageupload" multiple>
                        <button type="button" class="btn btn-info btn-lg right" id="galleryuploadbutton">Tải ảnh lên</button>
                    </div>
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
                        <div class="form-line {{$errors->has('active') ? 'focused error' : ''}}">
                            <label>Trạng thái</label>
                            <select name="active" class="form-control show-tick">
                                <option value="">-- Chọn một --</option>
                                <option value="1" {{ $property->active== '1' ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ $property->active== '0' ? 'selected' : '' }}>Không hiển thị</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line {{$errors->has('purpose') ? 'focused error' : ''}}">
                            <label>Kiểu tài sản</label>
                            <select name="purpose" class="form-control show-tick">
                                <option value="">-- Chọn một --</option>
                                <option value="sale" {{ $property->purpose=='sale' ? 'selected' : '' }}>Bán</option>
                                <option value="rent" {{ $property->purpose=='rent' ? 'selected' : '' }}>Cho thuê</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line {{$errors->has('type') ? 'focused error' : ''}}">
                            <label>Loại tài sản</label>
                            <select name="type" class="form-control show-tick">
                                <option value="">-- Chọn một --</option>
                                <option value="house" {{ $property->type=='house' ? 'selected' : '' }}>Nhà</option>
                                <option value="apartment" {{ $property->type=='apartment' ? 'selected' : '' }}>Căn hộ</option>
                            </select>
                        </div>
                    </div>

                    <h5>Tính năng khác</h5>
                    <div class="form-group demo-checkbox">
                        @foreach($features as $feature)
                            <input type="checkbox" id="features-{{$feature->id}}" name="features[]" class="filled-in chk-col-teal" value="{{$feature->id}}" 
                            @foreach($property->features as $checked)
                                {{ ($checked->id == $feature->id) ? 'checked' : '' }}
                            @endforeach
                            />
                            <label for="features-{{$feature->id}}">{{$feature->name}}</label>
                        @endforeach
                    </div>

                    <div class="clearfix">
                        <h5>Google Map</h5>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="location_latitude" class="form-control" value="{{$property->location_latitude}}" required/>
                                <label class="form-label">Vĩ độ</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="location_longitude" class="form-control" value="{{$property->location_longitude}}" required/>
                                <label class="form-label">Kinh độ</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="header bg-teal">
                    <h2>Video</h2>
                </div>
                <div class="body">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="video" value="{{$property->video}}">
                            <label class="form-label">Video</label>
                        </div>
                        <div class="help-info">Youtube Link</div>
                    </div>
                    <div class="embed-video center">
                        {!! $videoembed !!}
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
                    @foreach($property->time as $t)
                        <div class="form-group">
                            <input type="datetime-local" value="{{ $t }}" name="time[]" min="{{ date('Y-m-d\TH:i') }}">
                            <button type="button" class="btn btn-danger btn-sm waves-effect" onclick="this.parentElement.remove()">
                                <i class="material-icons">delete</i>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card">
                <div class="header bg-teal">
                    <h2>Sơ đồ mặt bằng</h2>
                </div>
                <div class="body">
                    <div class="form-group">
                        @if(Storage::disk('public')->exists('property/'.$property->floor_plan) && $property->floor_plan )
                            <img src="{{asset(Storage::url('property/'.$property->floor_plan))}}" alt="{{$property->title}}" class="img-responsive img-rounded"> <br>
                        @endif
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
                        @if(Storage::disk('public')->exists('property/'.$property->image))
                            <img src="{{asset(Storage::url('property/'.$property->image))}}" alt="{{$property->title}}" class="img-responsive img-rounded"> <br>
                        @endif
                        <input type="file" name="image">
                    </div>

                    {{-- BUTTON --}}
                    <a href="{{route('admin.properties.index')}}" class="btn btn-danger btn-lg m-t-15 waves-effect">
                        <i class="material-icons left">arrow_back</i>
                        <span>Quay lại</span>
                    </a>

                    <button type="submit" class="btn btn-teal btn-lg m-t-15 waves-effect">
                        <i class="material-icons">save</i>
                        <span>Cập nhật</span>
                    </button>

                </div>
            </div>

        </div>
        </form>
    </div>
    

@endsection


@push('scripts')

    <script src="{{ asset('backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // DELETE PROPERTY GALLERY IMAGE
        $('.gallery-image-edit button').on('click',function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var image = $('#gallery-'+id+' img').attr('alt');
            $.post("{{route('admin.gallery-delete')}}",{id:id,image:image},function(data){
                if(data.msg == true){
                    $('#gallery-'+id).remove();
                }
            });
        });

        $(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {

                            $('<div class="gallery-image-edit" id="gallery-perview-'+i+'"><img src="'+event.target.result+'" height="106" width="173"/></div>').appendTo(placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#gallaryimageupload').on('change', function() {
                imagesPreview(this, 'div#gallerybox');
            });
        });

        $(document).on('click','#galleryuploadbutton',function(e){
            e.preventDefault();
            $('#gallaryimageupload').click();
        })

    </script>

    <script src="{{asset('backend/plugins/tinymce/tinymce.js')}}"></script>
    <script>
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
