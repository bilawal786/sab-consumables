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
            @include('backend.damages.includes.blockHeader')
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="card planned_task">
                            <div class="header">
                                <h2>Damages Create</h2>
                                <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                    <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                                </ul>
                            </div>
                            <div class="body">
                                <create-damages date="{{$today}}"></create-damages>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @endsection
        @push('style')
            <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
            <link rel="stylesheet" href="{{asset('vendor/waitme/waitMe.css')}}">
            <style>
                .select2{
                    width: 100% !important;
                }
                .select2-hidden-accessible {
                    border: 0 !important;
                    clip: rect(0 0 0 0) !important;
                    height: 1px !important;
                    margin: -1px !important;
                    overflow: hidden !important;
                    padding: 0 !important;
                    position: absolute !important;
                    width: 1px !important
                }

                .select2-container--default .select2-selection--single,
                .select2-selection .select2-selection--single {
                    border: 1px solid #d2d6de;
                    border-radius: 0;
                    padding: 6px 12px;
                    height: 34px
                }

                .select2-container--default .select2-selection--single {
                    background-color: #fff;
                    border: 1px solid #aaa;
                    border-radius: 4px
                }

                .select2-container .select2-selection--single {
                    box-sizing: border-box;
                    cursor: pointer;
                    display: block;
                    height: 28px;
                    user-select: none;
                    -webkit-user-select: none
                }

                .select2-container .select2-selection--single .select2-selection__rendered {
                    padding-right: 10px
                }

                .select2-container .select2-selection--single .select2-selection__rendered {
                    padding-left: 0;
                    padding-right: 0;
                    height: auto;
                    margin-top: -3px
                }

                .select2-container--default .select2-selection--single .select2-selection__rendered {
                    color: #444;
                    line-height: 28px
                }

                .select2-container--default .select2-selection--single,
                .select2-selection .select2-selection--single {
                    border: 1px solid #d2d6de;
                    border-radius: 0 !important;
                    padding: 6px 12px;
                    height: 35px !important
                }

                .select2-container--default .select2-selection--single .select2-selection__arrow {
                    height: 26px;
                    position: absolute;
                    top: 6px !important;
                    right: 1px;
                    width: 20px
                }

                .sign-box {
                    border: 2px solid #E5E5E5;
                    width: 410px;
                }
            </style>
        @endpush
        @push('script')
            <script src="{{asset('js/select2.min.js')}}"></script>
            <script src="{{asset('vendor/waitme/waitMe.js')}}"></script>
            <script src="{{asset('js/damages.js')}}"></script>
        @endpush
