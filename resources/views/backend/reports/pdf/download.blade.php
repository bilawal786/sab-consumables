@extends('layouts.app')
@section('content')
    <div class="overlay"></div>
    <div id="wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>SAB Cosumables</h2>
                                <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                    <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);">Print Invoices</a></li>
                                            <li role="presentation" class="divider"></li>
                                            <li><a href="javascript:void(0);">Export to XLS</a></li>
                                            <li><a href="javascript:void(0);">Export to PDF</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
{{--                            <div class="body">--}}
{{--                                <h3>Surname : <strong class="text-primary">{{$employee->surname}}</strong></h3>--}}
{{--                                <div class="tab-content mt-3">--}}
{{--                                    <div class="tab-pane in active">--}}
{{--                                        <div class="row clearfix">--}}
{{--                                            <div class="col-md-6 col-sm-6">--}}
{{--                                                <p class="m-b-0"><strong>Employee No: </strong>{{$employee->employee_no}}</p>--}}
{{--                                                <p class="m-b-0"><strong>Inital: </strong>{{$employee->inital}}</p>--}}
{{--                                                <p class="m-b-0"><strong>Department: </strong>{{$employee->department}}</p>--}}
{{--                                                <p class="m-b-0"><strong>Allocate: </strong>{{$employee->allocate}}</p>--}}

{{--                                            </div>--}}
{{--                                            <div class="col-md-6 col-sm-6 text-right">--}}
{{--                                                <p class="m-b-0"><strong>Distribution Date: </strong>{{$date}}</p>--}}
{{--                                                <p><strong>Distribution By: </strong>{{$data[0]->user->first_name.' '.$data[0]->user->last_name}}</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="row clearfix">--}}
{{--                                            <div class="col-md-12">--}}
{{--                                                <div class="table-responsive">--}}
{{--                                                    <table class="table table-hover">--}}
{{--                                                        <thead class="thead-dark">--}}
{{--                                                        <tr>--}}
{{--                                                            <th>#</th>--}}
{{--                                                            <th>Brand name</th>--}}
{{--                                                            <th>Quantity</th>--}}
{{--                                                            <th>Assign Date</th>--}}
{{--                                                        </tr>--}}
{{--                                                        </thead>--}}
{{--                                                        <tbody>--}}
{{--                                                        @foreach($data as $stock)--}}
{{--                                                        <tr>--}}
{{--                                                            <td>{{$loop->index+1}}</td>--}}
{{--                                                            <td>{{$stock->brand->name}}</td>--}}
{{--                                                            <td>{{$stock->quantity}}</td>--}}
{{--                                                            <td>{{$stock->created_at->format('d-M-Y')}}</td>--}}
{{--                                                        </tr>--}}
{{--                                                        @endforeach--}}
{{--                                                        </tbody>--}}
{{--                                                    </table>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <hr>--}}
{{--                                        <div class="row clearfix">--}}
{{--                                            <div class="col-md-4">--}}
{{--                                                <div>--}}
{{--                                                    <p class="m-b-0"><strong>Picture: </strong></p>--}}
{{--                                                </div>--}}
{{--                                                <img src="{{asset($data[0]->picture)}}" class="img-fluid rounded float-left img-thumbnail" alt="Responsive image">--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-4"></div>--}}
{{--                                            <div class="col-md-4">--}}
{{--                                                <div>--}}
{{--                                                    <p class="m-b-0"><strong>Signature: </strong></p>--}}
{{--                                                </div>--}}
{{--                                                <img src="{{asset($data[0]->signature)}}" class="img-fluid rounded float-left img-thumbnail" alt="Responsive image">--}}
{{--                                            </div>--}}
{{--                                            <div class="hidden-print col-md-12 text-right">--}}
{{--                                                <hr>--}}
{{--                                                <button class="btn btn-outline-secondary" onclick="window.print()"><i class="icon-printer"></i></button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
