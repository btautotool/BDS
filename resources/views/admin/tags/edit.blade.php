@extends('backend.layouts.app')

@section('title', 'Edit Tags')

@push('styles')

    
@endpush


@section('content')

    <div class="block-header">
        <a href="{{route('admin.tags.index')}}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>Quay lại</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-teal">
                    <h2>Sửa tag</h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.tags.update',$tag->id)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="name" class="form-control" value="{{$tag->name}}">
                                <label class="form-label">Tên tag</label>
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



@endpush
