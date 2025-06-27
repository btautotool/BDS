@extends('frontend.layouts.app')

@section('styles')
<style>
    #map {
        height: 320px;
    }

    .jssorl-009-spin img {
        animation-name: jssorl-009-spin;
        animation-duration: 1.6s;
        animation-iteration-count: infinite;
        animation-timing-function: linear;
    }

    @keyframes jssorl-009-spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .jssora106 {display:block;position:absolute;cursor:pointer;}
    .jssora106 .c {fill:#fff;opacity:.3;}
    .jssora106 .a {fill:none;stroke:#000;stroke-width:350;stroke-miterlimit:10;}
    .jssora106:hover .c {opacity:.5;}
    .jssora106:hover .a {opacity:.8;}
    .jssora106.jssora106dn .c {opacity:.2;}
    .jssora106.jssora106dn .a {opacity:1;}
    .jssora106.jssora106ds {opacity:.3;pointer-events:none;}

    .jssort101 .p {position: absolute;top:0;left:0;box-sizing:border-box;background:#000;}
    .jssort101 .p .cv {position:relative;top:0;left:0;width:100%;height:100%;box-sizing:border-box;z-index:1;}
    .jssort101 .a {fill:none;stroke:#fff;stroke-width:400;stroke-miterlimit:10;visibility:hidden;}
    .jssort101 .p:hover .cv, .jssort101 .p.pdn .cv {border:none;border-color:transparent;}
    .jssort101 .p:hover{padding:2px;}
    .jssort101 .p:hover .cv {background-color:rgba(0,0,0,6);opacity:.35;}
    .jssort101 .p:hover.pdn{padding:0;}
    .jssort101 .p:hover.pdn .cv {border:2px solid #fff;background:none;opacity:.35;}
    .jssort101 .pav .cv {border-color:#fff;opacity:.35;}
    .jssort101 .pav .a, .jssort101 .p:hover .a {visibility:visible;}
    .jssort101 .t {position:absolute;top:0;left:0;width:100%;height:100%;border:none;opacity:.6;}
    .jssort101 .pav .t, .jssort101 .p:hover .t{opacity:1;}
</style>
@endsection

@section('content')

    <!-- SINGLE PROPERTY SECTION -->

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col s12 m8">
                    <div class="single-title">
                        <h4 class="single-title"><a href="{{route('property.show', $property->slug)}}">
                            <span class="card-title tooltipped" data-position="bottom" data-tooltip="{{ $property->title }}">{{ $property->title }}</span></a></h4>
                    </div>
                </div>
                <div class="col s12 m4">
                    <div>
                        <h4 class="left">{{ $property->price }} triệu đồng</h4>
                        <button type="button" class="btn btn-small m-t-25 right disabled b-r-20"> Tài sản {{ $property->purpose }}</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="clearfix">
                    <div>
                        <ul class="collection with-header m-t-0">
                            <li class="collection-header grey lighten-4">
                                <h5 class="m-0">Liên hệ với chủ nhà</h5>
                            </li>
                            <li class="collection-item p-0">
                                @if($property->user)
                                    <div class="card horizontal card-no-shadow">
                                        <div class="card-image p-l-10 agent-image">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/48px-User_icon_2.svg.png" alt="{{ $property->user->username }}" class="imgresponsive">
                                        </div>
                                        <div class="card-stacked">
                                            <div class="p-l-10 p-r-10">
                                                <h5 class="m-t-b-0">{{ $property->user->name }}</h5>
                                                <strong>{{ $property->user->email }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </li>

                            <li class="collection agent-message">
                                @guest()
                                    <span class="agent-message-box">
                                        Bạn vui lòng đăng nhập để đặt lịch hẹn
                                    </span>
                                @endguest
                                @auth()
                                    <form class="agent-message-box" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="agent_id" value="{{ $property->user->id }}">
                                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                        <input type="hidden" name="property_id" value="{{ $property->id }}">

                                        <div class="box">
                                            <input type="text" name="name" placeholder="Họ tên" value={{ Auth::user()->name }} required>
                                        </div>
                                        <div class="box">
                                            <input type="email" name="email" placeholder="Email" value={{ Auth::user()->email }} required>
                                        </div>
                                        <div class="box">
                                            <select name="time" class="browser-default" id="time" required>
                                                <option value="">Chọn lịch hẹn</option>
                                                @foreach($property->time as $time)
                                                    <option value="{{ $time }}" @if(in_array($time, $timeSelected)) disabled @endif>{{ \Carbon\Carbon::parse($time)->format('H:i d/m/Y') }}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                        <div class="box">
                                            <input type="tel" name="phone" placeholder="Điện thoại" pattern="(03|05|07|08|09|01[2689])[0-9]{8}" required>
                                        </div>
                                        <div class="box">
                                            <textarea name="message" placeholder="Ghi chú" required></textarea>
                                        </div>
                                        <div class="box">
                                            <button id="msgsubmitbtn" class="btn waves-effect waves-light w100 teal" type="submit">
                                                Đặt lịch
                                                <i class="material-icons left">send</i>
                                            </button>
                                        </div>
                                    </form>
                                @endauth
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://unpkg.com/sweetalert2@7.19.3/dist/sweetalert2.all.js"></script>
    <script>
        $(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // MESSAGE
            $(document).on('submit','.agent-message-box',function(e){
                e.preventDefault();

                var data = $(this).serialize();
                var url = "{{ route('property.message') }}";
                var btn = $('#msgsubmitbtn');
                
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    beforeSend: function() {
                        $(btn).addClass('disabled');
                        $(btn).empty().append('LOADING...<i class="material-icons left">rotate_right</i>');
                    },
                    success: function(data) {
                        if (data.message) {
                            M.toast({html: data.message, classes:'green darken-4'})
                            window.location.reload();
                        }
                    },
                    error: function(xhr) {
                        M.toast({html: xhr.statusText, classes: 'red darken-4'})
                    },
                    complete: function() {
                        $('form.agent-message-box')[0].reset();
                        $(btn).removeClass('disabled');
                        $(btn).empty().append('SEND<i class="material-icons left">send</i>');
                    },
                    dataType: 'json'
                });

            })
        })
    </script>
@endsection