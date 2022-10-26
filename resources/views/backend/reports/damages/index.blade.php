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
            @include('backend.reports.damages.includes.blockHeader')
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="card planned_task">
                            <div class="header">
                                <h2>Stock Report</h2>
                                <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                    <li>
                                        <a href="{{route('print.stock', ['date'=>$date])}}" target="_blank" class="btn btn-primary text-white"><i class="icon-printer"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Select month</label>
                                        <div class="input-group mb-3">
                                            <form method="get" action="{{route('stockreport.index')}}" class="navbar-form search-form">
                                                <input value="{{$date}}" name="date" class="form-control" type="month" style="padding-right: 40px;">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="icon-magnifier"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table
                                            class="table table-bordered table-hover table-striped js-basic-example dataTable table-custom">
                                            <thead>
                                            <tr>
                                                <th>Brand</th>
                                                <th>Remaining Stock</th>
                                                <th>Distribution</th>
                                                <th>Damages</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data as $damage)
                                                <tr>
                                                    <td>{{$damage->brand->name}}</td>
                                                    <td>{{$damage->quantity}}</td>
                                                    <td>{{$damage->distribution}}</td>
                                                    <td>{{$damage->damages}}</td>
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
    </div>
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
@endpush
@push('script')
    <script src="{{asset('bundles/datatablescripts.bundle.js')}}"></script>
    <script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script>
@endpush
