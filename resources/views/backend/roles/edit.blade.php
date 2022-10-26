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
                                <h2>Edit Role</h2>
                                <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                    <li><a href="javascript:void(0);" data-toggle="cardloading"
                                           data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                    <li><a href="javascript:void(0);" class="full-screen"><i
                                                class="icon-size-fullscreen"></i></a></li>
                                </ul>
                            </div>
                            <div class="body">

                                {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                                <div class="row">
                                    <div class="col-lg-6 col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <strong>Name:</strong>
                                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => "form-control")) !!}
                                            @if($errors->has('name'))
                                                <div class="error">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                    <div class="col-lg-6 col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <strong>Permission:</strong>
                                            <br/>
                                            @foreach($permission as $value)
                                                <label class="fancy-checkbox">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                    <span>{{ $value->name }}</span></label>
                                                <br/>
                                            @endforeach
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-lg-6 col-md-8 col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-round">Submit</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
