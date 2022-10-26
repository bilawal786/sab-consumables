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
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="card planned_task">
                            <div class="header">
                                <h2>Distribution Report</h2>
                                <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                    <li>
                                        <a href="{{route('print.distribution', ['date'=>$date])}}" target="_blank" class="btn btn-primary text-white"><i class="icon-printer"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Select month</label>
                                        <div class="input-group mb-3">
                                            <form method="get" action="{{route('distributereports.index')}}" class="navbar-form search-form">
                                                <input value="{{$date}}" name="date" class="form-control" type="month" style="padding-right: 40px;">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="icon-magnifier"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable table-custom">
                                        <thead>
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
                                                <td>
                                                    @can('distribution-report-show')
                                                    <a href="{{route('distributereports.show', [$distribution->employee_id, 'date'=>$date])}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                                    @endcan
                                                </td>
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
@push('style')
    <link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
@endpush
@push('script')
    <script src="{{asset('bundles/datatablescripts.bundle.js')}}"></script>
    <script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script>
@endpush
