@extends('layouts.app')

@section('content')
    <!-- Page Loader -->
    @include('backend.includes.loader')
    <?php
    $data = $brands;

    ?>
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
                                <h2>Stock Create</h2>
                                <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                    <li><a href="javascript:void(0);" data-toggle="cardloading"
                                           data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                    <li><a href="javascript:void(0);" class="full-screen"><i
                                                class="icon-size-fullscreen"></i></a></li>
                                </ul>
                            </div>
                            <div class="body">
                                <div class="body">
                                    <create-stock></create-stock>
{{--                                    <form method="POST" action="{{route('stocks.store')}}">--}}
{{--                                        @csrf--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-3">--}}
{{--                                            <label>Select month</label>--}}
{{--                                            <div class="input-group mb-3">--}}
{{--                                                <input name="date" type="month" class="form-control" value="{{$today}}" required>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-3">--}}
{{--                                            <div class="form-group m-0">--}}
{{--                                                <label>Barcode</label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-3">--}}
{{--                                            <div class="form-group m-0">--}}
{{--                                                <label>Brands</label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-3">--}}
{{--                                            <div class="form-group m-0">--}}
{{--                                                <label>Quantity</label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-3">--}}
{{--                                            <div class="form-group m-0">--}}
{{--                                                <label>Action</label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                        <div class="stockrow">--}}
{{--                                            <div class="row">--}}
{{--                                            <div class="col-md-3">--}}
{{--                                                <div class="input-group mb-3">--}}
{{--                                                    <input type="text" name="barcode[]" class="form-control"--}}
{{--                                                           placeholder="Barcode" required>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-3">--}}
{{--                                                <div class="input-group mb-3">--}}
{{--                                                    <select name="brand_id[]"--}}
{{--                                                            class="form-control single select2 select2-hidden-accessible"--}}
{{--                                                            style="width: 100%;" tabindex="-1" aria-hidden="true">--}}
{{--                                                        @foreach($data as $brand)--}}
{{--                                                            <option value="{{$brand->id}}">{{$brand->name}}</option>--}}
{{--                                                        @endforeach--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-3">--}}
{{--                                                <div class="input-group mb-3">--}}
{{--                                                    <input type="number" name="quantity[]" class="form-control"--}}
{{--                                                           placeholder="Quantity" required>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-3">--}}
{{--                                                <button onclick="appendStockRow()" class="btn btn-sm btn-icon btn-pure btn-primary on-editing m-r-5 button-save">--}}
{{--                                                    <i class="icon-plus"></i>--}}
{{--                                                </button>--}}
{{--                                                <button onclick="removeStockRow(this)"--}}
{{--                                                        class="btn btn-sm btn-icon btn-pure btn-danger on-editing m-r-5 button-save">--}}
{{--                                                    <i class="icon-trash"></i>--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        </div>--}}
{{--                                        <button type="submit" class="btn btn-primary">Save Stocks</button>--}}

{{--                                    </form>--}}
                                </div>
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
            <style>
                body {
                    background: #eee;
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
            </style>
        @endpush
        @push('script')
            <script src="{{asset('js/select2.min.js')}}"></script>
            <script src="{{asset('js/stock.js')}}"></script>
            <script>
                $(".single").select2({
                    placeholder: "Select brand",
                });
            </script>
    @endpush
