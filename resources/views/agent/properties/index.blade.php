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

                    <h4 class="agent-title">Danh sách tài sản</h4>
                    
                    <div class="agent-content">
                        <table class="striped responsive-table">
                            <thead>
                                <tr>
                                    <th>STT.</th>
                                    <th>Tên</th>
                                    <th>Loại tài sản</th>
                                    <th>Thành phố</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                    
                            <tbody>
                                @foreach( $properties as $key => $property )
                                    <tr>
                                        <td class="right-align">{{$key+1}}.</td>
                                        <td>
                                            <span class="tooltipped" data-position="bottom" data-tooltip="{{$property->title}}">
                                                {{ str_limit($property->title,30) }}
                                            </span>
                                        </td>
                                        
                                        <td>{{ ucfirst($property->type == 'house' ? 'Nhà' : 'Căn hộ') }}</td>
                                        <td>{{ ucfirst($property->city) }}</td>
                                        <td class="center">
                                            <a href="{{route('property.show',$property->slug)}}" target="_blank" class="btn btn-small green waves-effect">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                            <a href="{{route('agent.properties.edit',$property->slug)}}" class="btn btn-small orange waves-effect">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <button type="button" class="btn btn-small deep-orange accent-3 waves-effect" onclick="deleteProperty({{$property->id}})">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form action="{{route('agent.properties.destroy',$property->slug)}}" method="POST" id="del-property-{{$property->id}}" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="center">
                            {{ $properties->links() }}
                        </div>
                    </div>
        
                </div>

            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        function deleteProperty(id){
            swal({
            title: 'Cảnh báo',
            text: "Bạn có chắc chắn muốn xóa?",
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            buttons: ["Cancel", "Ok"]
            }).then((value) => {
                if (value) {
                    document.getElementById('del-property-'+id).submit();
                    swal(
                    'Xóa thành công',
                    'Đã xóa tài sản thành công',
                    'success',
                    {
                        buttons: false,
                        timer: 1000,
                    })
                }
            })
        }
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection