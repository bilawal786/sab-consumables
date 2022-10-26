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
            @include('backend.employees.includes.blockHeader')
            <div class="container-fluid">
                <div class="modal fade" id="employeeImport" tabindex="-1" role="dialog" aria-labelledby="employeeImportTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form method="post" action="{{route('employees.import')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Import Employee List</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Select month</label>
                                                <div class="input-group mb-3">
                                                    <input value="{{$date}}" name="date" class="form-control" type="month">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Select file</label>
                                                <div class="input-group mb-3">
                                                    <input  name="file" class="form-control" type="file">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" onClick="this.form.submit(); this.disabled=true; this.value='Sending…'; ">Import</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="card planned_task">
                            <div class="header">
                                <h2>Employees List</h2>
                                <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                    <li><a href="javascript:void(0);" data-toggle="cardloading"
                                           data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                    <li><a href="javascript:void(0);" class="full-screen"><i
                                                class="icon-size-fullscreen"></i></a></li>
                                </ul>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Select month</label>
                                        <div class="input-group mb-3">
                                            <form method="get" action="{{route('employee.index')}}" class="navbar-form search-form">
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
                                            <th>Inital</th>
                                            <th>Surname</th>
                                            <th>Paypoint</th>
                                            <th>Selection 1</th>
                                            <th>Selection 2</th>
                                            <th>Selection 3</th>
                                            <th>Shift bear</th>
                                            <th>Other bear</th>
                                            <th>Signature</th>
                                            <th>Y/N</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $employee)
                                            <tr>
                                                <td>{{$employee->employee_no}}</td>
                                                <td>{{$employee->inital}}</td>
                                                <td>{{$employee->surname}}</td>
                                                <td>{{$employee->paypoint}}</td>
                                                <td>{{$employee->selection_1}}</td>
                                                <td>{{$employee->selection_2}}</td>
                                                <td>{{$employee->selection_3}}</td>
                                                <td>{{$employee->shift_bear}}</td>
                                                <td>{{$employee->other_bear}}</td>
                                                <td>{{$employee->signature}}</td>
                                                <td>
                                                    @if($employee->status == 0)
                                                        <span class="badge badge-danger">No</span>
                                                    @endif
                                                    @if($employee->status == 1)
                                                        <span class="badge badge-success">Yes</span>
                                                    @endif
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

