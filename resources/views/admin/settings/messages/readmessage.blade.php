@extends('backend.layouts.app')

@section('title', 'Read Message')

@push('styles')

    
@endpush


@section('content')

    <div class="block-header">
        <a href="{{route('admin.message')}}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>Quay lại</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-teal">
                    <h2>Chi tiết lịch hẹn</h2>
                </div>
                <div class="body">
                    <h5>Từ: {{ $message->name }} <<em>{{ $message->email }}></em></h5>
                    <hr>

                    <h5>Ghi chú</h5>
                    <p>{!! $message->message !!}</p>
                    <hr>
                    <h5>Số điện thoại</h5>
                    <p>{{ $message->phone }}</p>
                    <hr>
                    <h5>Ngày tạo</h5>
                    <p>{{ date_format($message->created_at, 'd-m-Y') }}</p>
                    <hr>
                    <h5>Thời gian hẹn</h5>
                    <p>{{ \Carbon\Carbon::parse($message->time)->format('H:i d/m/Y') }}</p>

                    <form class="right" action="{{route('admin.message.readunread')}}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="{{ $message->status }}">
                        <input type="hidden" name="messageid" value="{{ $message->id }}">

                        @if(!$message->status)
                        <button type="submit" class="btn btn-warning btn-sm waves-effect">
                                <i class="material-icons">done</i>
                                <span>Đã hoàn thành</span>
                        </button>
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')

@endpush
