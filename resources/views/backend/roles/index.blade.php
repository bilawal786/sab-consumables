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
            @include('backend.roles.includes.blockHeader')
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="card planned_task">
                            <div class="header">
                                <h2>Role Management</h2>
                                <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                    <li><a href="javascript:void(0);" data-toggle="cardloading"
                                           data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                    <li><a href="javascript:void(0);" class="full-screen"><i
                                                class="icon-size-fullscreen"></i></a></li>
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                           role="button" aria-haspopup="true" aria-expanded="false"></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);">Action</a></li>
                                            <li><a href="javascript:void(0);">Another Action</a></li>
                                            <li><a href="javascript:void(0);">Something else</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-lg-12 margin-tb">




                                    </div>
                                </div>
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success">
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable table-custom">
                                    <tr>
                                        <th style="width: 70px;">Sr #</th>
                                        <th>Role Name</th>
                                        <th colspan="3">Action</th>
                                    </tr>
                                    @foreach ($roles as $key => $role)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td style="width: 75px">

                                                <a class="btn btn-sm btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
                                            </td>
                                            @if($role->id != 1)
                                            <td style="width: 75px">
                                                @can('role-edit')
                                                    <a class="btn btn-sm btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                                @endcan
                                            </td>
                                            <td style="width: 75px">
                                                @can('role-delete')
                                                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline;']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </table>


{{--                                {!! $roles->render() !!}--}}

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
