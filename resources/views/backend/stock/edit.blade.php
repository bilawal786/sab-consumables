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
                                <h2>Stock Edit</h2>
                                <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                    <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                                </ul>
                            </div>
                            <div class="body">
                                <form method="Post" action="{{route('stocks.update', [$data->id])}}">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Select month</label>
                                            <div class="input-group mb-3">
                                                <input name="date" type="month" class="form-control" value="{{$data->date}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group m-0">
                                                <label>Barcode</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group m-0">
                                                <label>Brands</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group m-0">
                                                <label>Quantity</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="stockrow">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="input-group mb-3">
                                                    <input type="text" name="barcode[]" class="form-control"
                                                           placeholder="Barcode" value="{{$data->barcode}}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group mb-3">
                                                    <select name="brand_id" class="form-control single select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" disabled>
                                                        @foreach($brands as $brand)
                                                            <option value="{{ $brand->id }}" {{$data->brand_id == $brand->id ? 'selected' : ''}}>{{$brand->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group mb-3">
                                                    <input type="number" name="quantity" min="1" value="{{$stocks}}" class="form-control"
                                                           placeholder="Quantity" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Stock</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
@endpush
@push('script')
    <script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('js/pages/forms/advanced-form-elements.js')}}"></script>
@endpush
