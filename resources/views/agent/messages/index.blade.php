@extends('frontend.layouts.app')

@section('styles')
@endsection

@section('content')

    <section class="section">
        <div class="container">
            <div class="row">

                <div class="col s12 m3">
                    <div class="agent-sidebar">
                        @include('agent.sidebar')
                    </div>
                </div>

                <div class="col s12 m9">

                    <h4 class="agent-title">Lịch hẹn
                        <a href="javascript:void(0)" class="btn waves-effect waves-light right headerightbtn" id="export_excel">
                            <i class="material-icons left">file_download</i>
                            <span>Excel </span>
                        </a>
                    </h4>
                    
                    <div class="agent-content">
                        <table class="striped responsive-table">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Thời gian</th>
                                    <th>SĐT</th>
                                    <th>Ghi chú</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                    
                            <tbody>
                                @foreach( $messages as $key => $message )
                                    <tr>
                                        <td class="right-align">{{$key+1}}.</td>
                                        <td>{{ ucfirst(strtok($message->name,' ')) }}</td>
                                        <td>{{ $message->email }}</td>
                                        <td>{{ \Carbon\Carbon::parse($message->time)->format('H:i d/m/Y') }}</td>
                                        <td>{{ $message->phone }}</td>
                                        <td>
                                            <span class="tooltipped" data-position="bottom" data-tooltip="{{$message->message}}">
                                                {{ str_limit($message->message,40) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($message->status == 0)
                                                <a href="{{route('agent.message.read',$message->id)}}" class="btn btn-small orange waves-effect">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                            @else 
                                                <a href="{{route('agent.message.read',$message->id)}}" class="btn btn-small green waves-effect">
                                                    <i class="material-icons">done</i>
                                                </a>
                                            @endif
                                            <button type="button" class="btn btn-small red waves-effect" onclick="deleteMessage({{$message->id}})">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form action="{{route('agent.messages.destroy',$message->id)}}" method="POST" id="del-message-{{$message->id}}" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="center">
                            {{ $messages->links() }}
                        </div>
                    </div>
        
                </div>

            </div>
        </div>
    </section>

@endsection

@section('scripts')
    @parent()
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#export_excel').click(function() {
                window.location.href = "{{ route('agent.message.export') }}";
            });
        });
        function deleteMessage(id){
            swal({
            title: 'Cảnh báo',
            text: "Bạn có chắc chắn muốn xóa",
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            buttons: ["Cancel", "OK"]
            }).then((value) => {
                if (value) {
                    document.getElementById('del-message-'+id).submit();
                    swal(
                    'Xóa thành công',
                    'Xóa lịch hẹn thành công',
                    'success',
                    {
                        buttons: false,
                        timer: 1000,
                    })
                }
            })
        }
    </script>
@endsection