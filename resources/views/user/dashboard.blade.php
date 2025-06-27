@extends('frontend.layouts.app')

@section('styles')
@endsection

@section('content')

    <section class="section">
        <div class="container">
            <div class="row">

                <div class="col s12 m3">
                    <div class="agent-sidebar">
                        @include('user.sidebar')
                    </div>
                </div>

                <div class="col s12 m9">

                    <h4 class="agent-title">DASHBOARD</h4>
                    
                    <div class="agent-content">
                    </div>
        
                </div>

            </div>
        </div>
    </section>

@endsection

@section('scripts')

@endsection