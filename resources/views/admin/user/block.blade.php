@extends('backend.layouts.app')

@section('title', 'User')

@push('styles')

    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}">

@endpush

@section('content')
    <div class="block-header">
        <a href="{{route('admin.user-manager.create')}}" class="waves-effect waves-light btn right m-b-15 addbtn">
            <i class="material-icons left">add</i>
            <span>Thêm mới </span>
        </a>
        <a href="{{route('admin.user-manager.block')}}" class="waves-effect waves-light btn right m-b-15 btn-danger">
            <i class="material-icons left">block</i>
            <span>Người dùng bị tố cáo</span>
        </a>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-teal">
                    <h2>Danh sach Người dùng bị tố cáo</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên người dùng</th>
                                    <th>Email</th>
                                    <th>Trạng thái</th>
                                    <th>Lý do tố cáo</th>
                                    <th>Xem</th>
                                    <th width="150">Khoá tài khoản</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach( $users as $key => $user )
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status == '1' ? 'Hoat dong' : 'Bi khoa'}}</td>
                                    <td>{{ $user->reason }}</td>
                                    <td>
                                        <a href="{{route('admin.user-manager.show', $user->id)}}" target="_blank" class="btn {{ $user->status == 1 ? 'btn-success' : 'btn-danger' }} btn-sm waves-effect">
                                            <i class="material-icons">visibility</i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        @if ($user->status == '1')
                                            <button type="button" class="btn btn-danger btn-sm waves-effect" onclick="blockUser({{$user->id}})">
                                                <i class="material-icons">block</i>
                                            </button>
                                            <form action="{{route('admin.user-manager.updateActice',$user->id)}}" method="POST" id="block-user-{{$user->id}}" style="display:none;">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                        @else
                                            <button type="button" class="btn btn-success btn-sm waves-effect" onclick="unBlockUser({{$user->id}})">
                                                <i class="material-icons">check</i>
                                            </button>
                                            <form action="{{route('admin.user-manager.updateActice',$user->id)}}" method="POST" id="block-user-{{$user->id}}" style="display:none;">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                        @endif
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
        function blockUser(id){
            
            swal({
            title: 'Canh bao',
            text: "Ban co chac chan muon Khoá tài khoản nay",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('block-user-'+id).submit();
                    swal(
                    'Khoá tài khoản thanh cong',
                    'Tai khoan nay da bi khoa',
                    'success'
                    )
                }
            })
        }
        function unBlockUser(id){
            
            swal({
            title: 'Canh bao',
            text: "Ban co chac chan muon mo Khoá tài khoản nay",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('block-user-'+id).submit();
                    swal(
                    'Mo Khoá tài khoản thanh cong',
                    'Tai khoan nay da duoc mo khoa',
                    'success'
                    )
                }
            })
        }
    </script>


@endpush