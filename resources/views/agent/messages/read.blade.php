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

                    <h4 class="agent-title">Chi tiết lịch hẹn</h4>
                    
                    <div class="agent-content">
                        
                        <span><strong>Từ:</strong> <em>{{ $message->name }} < {{ $message->email }} ></em></span> <br>
                        <span><strong>Số điện thoại:</strong> {{ $message->phone }}</span><br/>
                        <span><strong>Thời gian gửi:</strong> {{ date_format($message->created_at, 'h:m:s d-m-Y') }}</span>
                        <span><strong>Thời gian hẹn:</strong> {{ \Carbon\Carbon::parse($message->time)->format('H:i d/m/Y') }}</span>
                        <div class="read-message">
                            <span>Ghi chú:</span>
                            <p>{!! $message->message !!}</p>
                        </div>

                        <form class="right" action="{{route('agent.message.readunread')}}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="{{ $message->status }}">
                            <input type="hidden" name="messageid" value="{{ $message->id }}">

                            @if(!$message->status)
                            <button type="submit" class="btn btn-small orange waves-effect">
                                    <i class="material-icons left">check</i>
                                    <span>Đã hoàn thành</span>
                            </button>
                            @endif
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('scripts')

@endsection