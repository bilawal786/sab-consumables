@extends('layouts.app')

@section('content')
    <!-- Page Loader -->
    @include('backend.includes.loader')
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <div id="wrapper">
        @include('backend.includes.navigation')
        @include('backend.includes.leftsidebar')
        <div id="main-content">
            @include('backend.stock.includes.blockHeader')
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="card planned_task">
                            <div class="header">
                                <h2>Stock Detail</h2>
                                <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                    <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                                </ul>
                            </div>
                            <div class="body">
                                <h4>Stater Page</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
@endpush
@push('script')
    <script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('js/pages/forms/advanced-form-elements.js')}}"></script>
@endpush
