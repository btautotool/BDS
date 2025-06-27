@extends('backend.layouts.app')

@section('title', 'Edit Post')

@push('styles')

    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">

@endpush


@section('content')

    <div class="block-header"></div>

    <div class="row clearfix">
        <form action="{{route('admin.posts.update',$post->slug)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-teal">
                    <h2>S&#7917;a bài vi&#7871;t</h2>
                </div>
                <div class="body">

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" name="title" class="form-control" value="{{$post->title}}">
                            <label class="form-label">Tên bài vi&#7871;t</label>
                        </div>
                    </div>

                    <div class="form-group">
                        @if($post->status)
                            @php 
                                $checked = 'checked'; 
                            @endphp
                        @else
                            @php 
                                $checked = ''; 
                            @endphp
                        @endif
                        <input type="checkbox" id="published" name="status" class="filled-in" value="1" {{$checked}}/>
                        <label for="published">Công khai bài vi&#7871;t</label>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">N&#7897;i dung bài vi&#7871;t</label>
                        <textarea name="body" id="tinymce">{{$post->body}}</textarea>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-teal">
                    <h2>Ch&#7885;n th&#7875; lo&#7841;i</h2>
                </div>
                <div class="body">

                    <div class="form-group form-float">
                        <div class="form-line {{$errors->has('categories') ? 'focused error' : ''}}">
                            <label for="categories">Ch&#7885;n th&#7875; lo&#7841;i</label>
                            <select name="categories[]" class="form-control show-tick" id="categories" multiple>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line {{$errors->has('tags') ? 'focused error' : ''}}">
                            <label for="tags">Ch&#7885;n Tag</label>
                            <select name="tags[]" class="form-control show-tick" id="tags" multiple>
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="form-label">&#7842;nh mô t&#7843;</label>
                        <input type="file" name="image">
                    </div>


                    <a href="{{route('admin.posts.index')}}" class="btn btn-danger btn-lg m-t-15 waves-effect">
                        <i class="material-icons left">arrow_back</i>
                        <span>Quay l&#7841;i</span>
                    </a>

                    <button type="submit" class="btn btn-teal btn-lg m-t-15 waves-effect">
                        <i class="material-icons">update</i>
                        <span>C&#7853;p nh&#7853;t</span>
                    </button>

                </div>
            </div>
        </div>
        </form>
    </div>

    {{-- SELECTED CATEGORIES --}}
    @php
        $categories = [];
    @endphp
    @foreach($post->categories as $category)
        @php 
            $categories[] = $category->id;
        @endphp
    @endforeach

@endsection


@push('scripts')

    <script src="{{ asset('backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script>
        @php
            $selectedcategory = json_encode($categories);
            $selectedtags = json_encode($selectedtag);
        @endphp

        $('#categories').selectpicker();
        $('#categories').selectpicker('val',{{$selectedcategory}});

        $('#tags').selectpicker();
        $('#tags').selectpicker('val',{{$selectedtags}});
        
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
    </script>

@endpush
