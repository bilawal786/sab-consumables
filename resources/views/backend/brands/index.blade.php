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
            @include('backend.brands.includes.blockHeader')
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="card planned_task">
                            <div class="header">
                                <h2>Brands List</h2>
                                <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                    <li><a href="javascript:void(0);" data-toggle="cardloading"
                                           data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                    <li><a href="javascript:void(0);" class="full-screen"><i
                                                class="icon-size-fullscreen"></i></a></li>
                                </ul>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table
                                                class="table table-bordered table-striped table-hover js-basic-example dataTable table-custom">
                                                <thead>
                                                <tr>
                                                    <th>Brand Name</th>
                                                    <th>Created By</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data as $brand)
                                                    <tr>
                                                        <td>{{$brand->name}}</td>
                                                        <td>
                                                            <a href="{{route('users.show', [$brand->user_id])}}">{{$brand->user->first_name.' '.$brand->user->last_name}}</a>
                                                        </td>
                                                        <td>{{date('d-m-Y', strtotime($brand->created_at))}}</td>
                                                        <td class="actions">
                                                            @can('brand-edit')
                                                                <a href="{{route('brands.edit', [$brand->id])}}"
                                                                   class="btn btn-sm btn-icon btn-pure btn-primary on-editing m-r-5 button-save">
                                                                    <i class="icon-pencil"></i>
                                                                </a>
                                                            @endcan
                                                            @can('brand-delete')
                                                                <a href="{{route('brands.delete', [$brand->id])}}"
                                                                   id="delete"
                                                                   onclick="event.preventDefault(); document.getElementById('brand-delete').submit();"
                                                                   class="btn btn-sm btn-icon btn-pure btn-danger on-editing m-r-5 button-save">
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
    </div>

@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
@endpush
@push('script')
    <script src="{{asset('bundles/datatablescripts.bundle.js')}}"></script>
    <script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script>
@endpush
