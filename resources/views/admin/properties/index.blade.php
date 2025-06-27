@extends('backend.layouts.app')

@section('title', 'Properties')

@push('styles')

    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}">

@endpush

@section('content')

    <div class="block-header">
        <a href="{{route('admin.properties.create')}}" class="waves-effect waves-light btn right m-b-15 addbtn">
            <i class="material-icons left">add</i>
            <span>Thêm mới</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-teal">
                    <h2>Danh sách tài sản</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên tài sản</th>
                                    <th>Tác giả</th>
                                    <th>Loại tài sản</th>
                                    <th>Kiểu tài sản</th>
                                    <th width="150">Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach( $properties as $key => $property )
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        @if(Storage::disk('public')->exists('property/'.$property->image) && $property->image)
                                            <img src="{{asset(Storage::url('property/'.$property->image))}}" alt="{{$property->title}}" width="60" class="img-responsive img-rounded">
                                        @endif
                                    </td>
                                    <td>
                                        <span title="{{$property->title}}">
                                            {{ str_limit($property->title,10) }}
                                        </span>
                                    </td>
                                    <td>{{$property->user->name}}</td>
                                    <td>{{$property->type == 'house' ? 'Nhà' : 'Căn hộ'}}</td>
                                    <td>{{$property->purpose == 'sale' ? 'Bán' : 'Cho thuê'}}</td>

                                    <td class="text-center">
                                        <a href="{{route('property.show',$property->slug)}}" target="_blank" class="btn btn-success btn-sm waves-effect">
                                            <i class="material-icons">visibility</i>
                                        </a>
                                        <a href="{{route('admin.properties.edit',$property->slug)}}" class="btn btn-info btn-sm waves-effect">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm waves-effect" onclick="deletePost({{$property->id}})">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <form action="{{route('admin.properties.destroy',$property->slug)}}" method="POST" id="del-post-{{$property->id}}" style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('backend/js/pages/tables/jquery-datatable.js') }}"></script>

    <script>
        function deletePost(id){
            
            swal({
            title: 'Canh bao',
            text: "Ban co chac chan muon xoa tai san nay?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('del-post-'+id).submit();
                    swal(
                    'Xoa thanh cong',
                    'Tai san da duoc xoa',
                    'success'
                    )
                }
            })
        }
    </script>


@endpush