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
                                <h2>Damages</h2>
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
                                            <form method="get" action="{{route('damages.index')}}"
                                                  class="navbar-form search-form">
                                                <input value="{{$date}}" name="date" class="form-control" type="month"
                                                       style="padding-right: 40px;">
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
                                                <th>Quantity</th>
                                                <th>Status</th>
                                                <th>User</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data as $damage)
                                                <tr>
                                                    <td>{{$damage->brand->name}}</td>
                                                    <td>{{$damage->quantity}}</td>
                                                    <td>
                                                        @if($damage->status == 'p')
                                                            <span class="badge badge-info">Pending</span>
                                                        @endif
                                                        @if($damage->status == 'a')
                                                                <span class="badge badge-success">Approved</span>
                                                        @endif
                                                        @if($damage->status == 'd')
                                                                <span class="badge badge-danger">Declined</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{route('users.show', [$damage->user->id])}}">{{$damage->user->first_name.' '.$damage->user->last_name}}</a>
                                                    </td>
                                                    <td>
                                                        @if($damage->status == 'p')
                                                            @can('damages-approve')
                                                            <a href="{{route('damages.approved', [$damage->id, 'date'=>date('Y-m')])}}" id="approved" class="btn btn-simple btn-sm mb-1 btn-success btn-filter" data-target="approved">Approved</a>
                                                            @endcan
                                                            @can('damages-reject')
                                                            <a href="{{route('damages.reject', [$damage->id, 'date'=>date('Y-m')])}}" id="reject" class="btn btn-simple btn-sm mb-1 btn-danger btn-filter" data-target="reject">Reject</a>
                                                                @endcan
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
    </div>

@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
@endpush
@push('script')
    <script src="{{asset('bundles/datatablescripts.bundle.js')}}"></script>
    <script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script>
@endpush
