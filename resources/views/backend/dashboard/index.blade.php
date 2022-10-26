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
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Dashboard</h2>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"><i class="icon-home"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-12">
                        <div class="card top_report">
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="body">
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <i class="fa fa-2x fa-list text-col-blue"></i>
                                            </div>
                                            <div class="number float-right text-right">
                                                <h6>Brands</h6>
                                                <span class="font700">{{$brands}}</span>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                            <div class="progress-bar" data-transitiongoal="100" aria-valuenow="100" style="width: 100%;"></div>
                                        </div>
                                        <small class="text-muted">Total Brands</small>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="body">
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <i class="fa fa-2x fa-users text-col-red"></i>
                                            </div>
                                            <div class="number float-right text-right">
                                                <h6>Employees</h6>
                                                <span class="font700">{{$employees}}</span>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs progress-transparent custom-color-red mb-0 mt-3">
                                            <div class="progress-bar" data-transitiongoal="100" aria-valuenow="100" style="width: 100%;"></div>
                                        </div>
                                        <small class="text-muted">Current Month Employees</small>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="body">
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <i class="fa fa-2x fa-dropbox text-col-green"></i>
                                            </div>
                                            <div class="number float-right text-right">
                                                <h6>Stock</h6>
                                                <span class="font700">{{$stock}}</span>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                                            <div class="progress-bar" data-transitiongoal="100" aria-valuenow="100" style="width: 100%;"></div>
                                        </div>
                                        <small class="text-muted">Current Month Stock</small>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="body">
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <i class="fa fa-2x fa-chain-broken text-col-yellow"></i>
                                            </div>
                                            <div class="number float-right text-right">
                                                <h6>Damages</h6>
                                                <span class="font700">{{$damages}}</span>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs progress-transparent custom-color-yellow mb-0 mt-3">
                                            <div class="progress-bar" data-transitiongoal="100" aria-valuenow="100" style="width: 100%;"></div>
                                        </div>
                                        <small class="text-muted">Current Month Damages</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2>Lastest Distribution</h2>
                                <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                    <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                                </ul>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-hover js-basic-example dataTable table-custom mb-0">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th>Employee No.</th>
                                            <th>Surname</th>
                                            <th>Paypoint</th>
                                            <th>Selection 1</th>
                                            <th>Selection 2</th>
                                            <th>Brands.</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $distribution)
                                            <tr>
                                                <td>{{$distribution->employee->employee_no}}</td>
                                                <td>{{$distribution->employee->surname}}</td>
                                                <td>{{$distribution->employee->paypoint}}</td>
                                                <td>{{$distribution->employee->selection_1}}</td>
                                                <td>{{$distribution->employee->selection_2}}</td>
                                                @php
                                                    $brands = \App\Models\Distrebution::with('brand')->where('employee_id', $distribution->employee_id)->get();
                                                @endphp
                                                <td>
                                                    @foreach($brands as $brand)
                                                        <span class="badge badge-primary">{{$brand->brand->name}}</span>
                                                    @endforeach
                                                </td>
                                                <td><a href="{{route('distributereports.show', [$distribution->employee_id, 'date'=>$date])}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
