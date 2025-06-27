@extends('backend.layouts.app')

@section('title', 'Messages')

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}">
@endpush


@section('content')

    <div class="block-header"></div>

    <div class="row clearfix">

        <div class="col-xs-12">
            <div class="card">
                <div class="header bg-teal">
                    <h2>Danh sách lịch hẹn
                        <a href="javascript:void(0)" class="btn waves-effect waves-light right headerightbtn" id="export_excel">
                            <i class="material-icons left">file_download</i>
                            <span>Excel </span>
                        </a>
                    </h2>
                </div>
                <div class="body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên người yêu cầu</th>
                                    <th>Email</th>
                                    <th>Thời gian</th>
                                    <th>Điện thoại</th>
                                    <th>Ghi chú</th>
                                    <th>Ngày tạo</th>
                                    <th width="150px">Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach( $messages as $key => $message )
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$message->name}}</td>
                                    <td>{{$message->email}}</td>
                                    <td>{{ \Carbon\Carbon::parse($message->time)->format('H:i d/m/Y') }}</td>
                                    <td>{{$message->phone}}</td>
                                    <td>{{ str_limit($message->message,40,'...') }}</td>
                                    <td>{{ date_format($message->created_at, 'd-m-Y') }}</td>
                                    <td>
                                        @if($message->status == 0)
                                            <a href="{{route('admin.message.read',$message->id)}}" class="btn btn-warning btn-sm waves-effect">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                        @else 
                                            <a href="{{route('admin.message.read',$message->id)}}" class="btn btn-success btn-sm waves-effect">
                                                <i class="material-icons">done</i>
                                            </a>
                                        @endif
                                        <button type="button" class="btn btn-danger btn-sm waves-effect" onclick="deleteMessage({{$message->id}})">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <form action="{{route('admin.messages.destroy',$message->id)}}" method="POST" id="del-message-{{$message->id}}" style="display:none;">
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
        $(document).ready(function() {
            $('#export_excel').click(function() {
                window.location.href = "{{ route('admin.message.export') }}";
            });
        });

        function deleteMessage(id){
            
            swal({
            title: 'Cảnh báo',
            text: "Bạn có chắc muốn xóa?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('del-message-'+id).submit();
                    swal(
                    'Xóa thành công',
                    'Đã xóa lịch hẹn thành công',
                    'success'
                    )
                }
            })
        }
    </script>

@endpush
