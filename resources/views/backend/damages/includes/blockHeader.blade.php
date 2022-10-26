<div class="block-header">
    <div class="row clearfix">
        <div class="col-md-6 col-sm-12">
            <h2>Damages</h2>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('damages.index')}}">Damages</a></li>
            </ul>
            @can('damages-create')
            <a class="btn btn-sm btn-primary btn-round" href="{{ route('damages.create') }}"> Create Damages</a>
            @endcan
        </div>
    </div>
</div>
