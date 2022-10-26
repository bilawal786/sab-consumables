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
            @include('backend.reports.distribution.includes.blockHeader')
            <div class="container-fluid" id="printableArea">
                <div class="row clearfix">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="header">
                                <h2>SAB O & G</h2>
                                <ul class="header-dropdown dropdown dropdown-animated scale-left">

                                </ul>
                            </div>
                            <div class="body ml-5 mr-5">
                                <div class="row">
                                    <div class="col-md-8">

                                    </div>
                                    <div class="col-md-4">
                                        <?php
                                        $setting = \App\Models\Settings::first();
                                        ?>
                                        <div class="">
                                            <img src="{{asset($setting->logo1)}}" class="img-fluid float-right" alt="Responsive image">
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <h6>Surname : <strong class="text-primary">{{$employee->surname}}</strong></h6>
                                <div class="tab-content mt-3">
                                    <div class="tab-pane in active">
                                        <div class="row clearfix mb-5">
                                            <div class="col-md-6 col-sm-6">
                                                <p class="m-b-0"><strong>Employee No: </strong>{{$employee->employee_no}}</p>
                                                <p class="m-b-0"><strong>Inital: </strong>{{$employee->inital}}</p>
                                                <p class="m-b-0"><strong>Paypoint: </strong>{{$employee->paypoint}}</p>
                                                <p class="m-b-0"><strong>Selection 1: </strong>{{$employee->selection_1}}</p>
                                                <p class="m-b-0"><strong>Selection 2: </strong>{{$employee->selection_2}}</p>
                                                <p class="m-b-0"><strong>Selection 3: </strong>{{$employee->selection_3}}</p>
                                                <p class="m-b-0"><strong>shift bear: </strong>{{$employee->shift_bear}}</p>
                                                <p class="m-b-0"><strong>other bear: </strong>{{$employee->other_bear}}</p>
                                            </div>
                                            <div class="col-md-6 col-sm-6 text-right">
                                                <p class="m-b-0"><strong>Distribution Date: </strong>{{$date}}</p>
                                                <p><strong>Distribution By: </strong>{{$data[0]->user->first_name.' '.$data[0]->user->last_name}}</p>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead class="thead-dark">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Brand name</th>
                                                            <th>Quantity</th>
                                                            <th>Assign Date</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($data as $stock)
                                                        <tr>
                                                            <td>{{$loop->index+1}}</td>
                                                            <td>{{$stock->brand->name}}</td>
                                                            <td>{{$stock->quantity}}</td>
                                                            <td>{{$stock->created_at->format('d-M-Y')}}</td>
                                                        </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row clearfix">
                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <p class="m-b-0"><strong>Picture: </strong></p>
                                                </div>
                                                <img src="{{asset($data[0]->picture)}}" class="img-fluid rounded float-left img-thumbnail" alt="Responsive image">
                                            </div>
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <p class="m-b-0"><strong>Signature: </strong></p>
                                                </div>
                                                <img src="{{asset($data[0]->signature)}}" class="img-fluid rounded float-left img-thumbnail" alt="Responsive image">
                                            </div>
                                            <div class="hidden-print col-md-12 text-right">
                                                <hr>
                                                <button id="btn" class="btn btn-outline-secondary" onclick="printDiv('printableArea')"><i class="icon-printer"></i></button>
                                            </div>

                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="col-lg-2"></div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
@endpush
@push('script')
    <script src="{{asset('bundles/datatablescripts.bundle.js')}}"></script>
    <script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script>
    <script>
        function printDiv(divName) {
            var printButton = document.getElementById("btn");
            printButton.style.visibility = 'hidden';
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            printButton.style.visibility = 'visible';
        }
        var printButton = document.getElementById("btn");
        printButton.style.visibility = 'visible';
    </script>
@endpush

