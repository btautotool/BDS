@extends('backend.layouts.app')

@section('title', 'Edit Categories')

@push('styles')

    
@endpush


@section('content')

    <div class="block-header">
        <a href="{{route('admin.categories.index')}}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>Quay lại</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-teal">
                    <h2>Sửa thể loại tin tức</h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.categories.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="name" class="form-control" value="{{$category->name}}">
                                <label class="form-label">Tên thể loại</label>
                            </div>
                        </div>

                        @if(Storage::disk('public')->exists('category/thumb/'.$category->image))
                            <div class="form-group">
                                <img src="{{asset(Storage::url('category/thumb/'.$category->image))}}" alt="{{$category->name}}" class="img-responsive img-rounded">
                            </div>
                        @endif
                        <div class="form-group">
                            <input type="file" name="image">
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



@endpush
