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
                                <h2>Stock List</h2>
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
                                            <form method="get" action="{{route('stocks.index')}}" class="navbar-form search-form">
                                                <input value="{{$today}}" name="date" class="form-control" type="month" style="padding-right: 40px;">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="icon-magnifier"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover table-striped js-basic-example dataTable table-custom">
                                            <thead>
                                            <tr>
                                                <th>Barcode</th>
                                                <th>Brand</th>
                                                <th>Quantity</th>
                                                <th>Stock Date</th>
                                                <th>Add By</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data as $stock)
                                            <tr>
                                                <td>{{$stock->barcode}}</td>
                                                <td>{{$stock->brand->name}}</td>
                                                <td>{{$stock->quantity}}</td>
                                                <td>{{$stock->date}}</td>
                                                <td><a href="{{route('users.show', [$stock->user->id])}}">{{$stock->user->first_name.' '.$stock->user->last_name}}</a></td>
                                                <td class="actions">
{{--                                                    @can('stock-edit')--}}
{{--                                                    <a href="{{route('stocks.edit', [$stock->id])}}" class="btn btn-sm btn-icon btn-pure btn-primary on-default m-r-5 button-edit" data-original-title="Edit">--}}
{{--                                                        <i class="icon-pencil"></i>--}}
{{--                                                    </a>--}}
{{--                                                    @endcan--}}
                                                    @can('stock-delete')
                                                    <a href="{{ route('stocks.delete', [$stock->id, 'date'=>$today])}}" id="delete" class="btn btn-sm btn-icon btn-pure btn-danger on-default button-remove" data-original-title="Remove">
                                                        <i class="icon-trash"></i>
                                                    </a>
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
    </div>
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
@endpush
@push('script')
    <script src="{{asset('bundles/datatablescripts.bundle.js')}}"></script>
    <script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script>
@endpush
