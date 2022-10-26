<div class="block-header">
    <div class="row clearfix">
        <div class="col-md-6 col-sm-12">
            <h2>Brands</h2>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active"><a href="{{route('brands.index')}}">Brands</a> </li>
            </ul>
            @can('brand-create')
            <a class="btn btn-sm btn-primary btn-round" href="{{ route('brands.create') }}"> Create New Brand</a>
            @endcan
        </div>
    </div>
</div>
