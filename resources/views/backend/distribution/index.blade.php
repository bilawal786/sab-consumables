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
            @include('backend.distribution.includes.blockHeader')
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="card planned_task">
                            <div class="header">
                                <h2>Distribution</h2>
                                <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                    <li><a href="javascript:void(0);" data-toggle="cardloading"
                                           data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                    <li><a href="javascript:void(0);" class="full-screen"><i
                                                class="icon-size-fullscreen"></i></a></li>
                                </ul>
                            </div>
                            <div class="body">
                                <add-distribution></add-distribution>
{{--                                <form method="POST" class="stockForm"--}}
{{--                                      action="{{route('distribution.store', ['date'=>$date])}}" style="display: none"--}}
{{--                                      enctype="multipart/form-data">--}}
{{--                                    @csrf--}}
{{--                                    <div class="row">--}}
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

{{--                                    <div class="stockrow">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-3">--}}
{{--                                                <div class="input-group mb-3">--}}
{{--                                                    <select onchange="selectBrandId(this)" name="brand_id[]"--}}
{{--                                                            class="form-control single select2 select2-hidden-accessible"--}}
{{--                                                            style="width: 100%;" tabindex="-1" aria-hidden="true">--}}
{{--                                                        <option value="0">Select Brand</option>--}}
{{--                                                    @foreach($brands as $brand)--}}
{{--                                                        <option value="{{$brand->id}}">{{$brand->brand->name}}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-2">--}}
{{--                                                <div id="stockquantity"></div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-3">--}}
{{--                                                <div class="input-group mb-3">--}}
{{--                                                    <input onfocusout="disableoutput(this)" type="number" id="ms_num"--}}
{{--                                                           name="quantity[]"--}}
{{--                                                           class="form-control ms_num"--}}
{{--                                                           placeholder="Quantity" required>--}}
{{--                                                    <input type="number"--}}
{{--                                                           name="quantity[]"--}}
{{--                                                           class="form-control ms_num"--}}
{{--                                                           placeholder="Quantity" required>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-3">--}}
{{--                                                <button onclick="appendStockRow(this)"--}}
{{--                                                        class="btn btn-sm btn-icon btn-pure btn-primary on-editing m-r-5 button-save">--}}
{{--                                                    <i class="icon-plus"></i>--}}
{{--                                                </button>--}}
{{--                                                <button onclick="removeStockRow(this)"--}}
{{--                                                        class="btn btn-sm btn-icon btn-pure btn-danger on-editing m-r-5 button-save">--}}
{{--                                                    <i class="icon-trash"></i>--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label>Signature</label>--}}
{{--                                                <!-- Signature -->--}}
{{--                                                <div id="signature" class="sign-box">--}}
{{--                                                    <canvas id="signature-pad" class="signature-pad" width="400px"--}}
{{--                                                            height="190px"></canvas>--}}
{{--                                                </div>--}}
{{--                                                <br/>--}}
{{--                                                <input class="btn btn-info btn-sm" type='button' id='click'--}}
{{--                                                       value='Confirm Sign'>--}}
{{--                                                <input class="btn btn-warning btn-sm" style="color: #FFF;" type='button'--}}
{{--                                                       id='clear' value='Clear'>--}}
{{--                                                <input type="hidden" id="output" name="signature">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label>Preview Signature</label>--}}
{{--                                                <div class="sign-box" style="height: 200px;">--}}
{{--                                                    <img src='' id='sign_prev'/>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label>Picture</label>--}}
{{--                                                <input type="file" name="picture" class="form-control"--}}
{{--                                                       id="dropify-event-picture" data-default-file="">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-12" style="margin: 40px 0;">--}}
{{--                                            <input type="hidden" id="employeeId" name="employeeId" value="">--}}
{{--                                            <button type="submit" class="btn btn-primary">Save Stocks</button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('vendor/dropify/css/dropify.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.signaturepad.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
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
    <script src="{{asset('vendor/dropify/js/dropify.min.js')}}"></script>
    <script src="{{asset('js/pages/forms/dropify.js')}}"></script>
    <script src="{{asset('bundles/datatablescripts.bundle.js')}}"></script>
    <script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{mix('js/distribution.js')}}"></script>
{{--    <script>--}}
{{--        function getEmployeeId(elem) {--}}
{{--            $(".stockForm").show();--}}
{{--            $("#employeeId").val(elem.value);--}}
{{--        }--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        function appendStockRow(e) {--}}
{{--            $(e).parent().find()--}}
{{--            var count = 0;--}}
{{--            $('.stockrow').append("<div class='row'><div class='col-md-3'><div class='input-group mb-3'><select onchange='selectBrandId(this)' name='brand_id[]' class= 'form-control single select2 select2-hidden-accessible' style = 'width: 100%;' tabindex = '-1' aria - hidden = 'true'>@foreach($brands as $brand)<option value = '{{$brand->brand_id}}' > {{$brand->brand->name}}@endforeach</select> </div> </div> <div class='col-md-2'> <div id='stockquantity'></div></div> <div class='col-md-3'> <div class='input-group mb-3'><input type='number' id='ms_num" + count + 1 + "' name='quantity[]' class='form-control ms_num' placeholder='Quantity' required> </div> </div> <div class='col-md-3'> <button onclick='removeStockRow(this)' class='btn btn-sm btn-icon btn-pure btn-danger on-editing m-r-5 button-save'> <i class='icon-trash'></i> </button> </div> </div><script>$('.single').select2({placeholder: 'Select brand',})");--}}
{{--        }--}}

{{--        function removeStockRow(elem) {--}}
{{--            $(elem).parent('div').parent('div').remove();--}}
{{--        }--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        $(".single").select2({--}}
{{--            placeholder: "Select brand",--}}
{{--        });--}}
{{--    </script>--}}

    <script src="{{asset('js/signature_pad.js')}}"></script>

    <script>
        $(document).ready(function () {
            var signaturePad = new SignaturePad(document.getElementById('signature-pad'));
            $('#click').click(function () {
                var data = signaturePad.toDataURL('image/png');
                $('#output').val(data);
                $("#sign_prev").show();
                $("#sign_prev").attr("src", data);
                // Send data to server instead...
                //window.open(data);
            });
            $('#clear').click(function () {
                var data = signaturePad.clear();
            });
        })
    </script>
{{--    <script>--}}
{{--        function selectBrandId(e) {--}}
{{--            let id = e.value;--}}
{{--            $.ajaxSetup({--}}
{{--                headers: {--}}
{{--                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')--}}
{{--                }--}}
{{--            });--}}
{{--            $.ajax({--}}
{{--                url: "{{route('getstock')}}",--}}
{{--                type: "GET",--}}
{{--                dataType: "json",--}}
{{--                data: {--}}
{{--                    id: id,--}}
{{--                },--}}
{{--                success: function (response) {--}}
{{--                    $("#stockquantity").html(response);--}}
{{--                    $(".ms_num").attr('max', response);--}}
{{--                },--}}
{{--            });--}}
{{--        }--}}

{{--        function disableoutput(e) {--}}
{{--            $(e).prop("disabled", true);--}}
{{--        }--}}
{{--    </script>--}}
@endpush
