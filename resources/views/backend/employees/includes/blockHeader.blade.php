<div class="block-header">
    <div class="row clearfix">
        <div class="col-md-6 col-sm-12">
            <h2>Employees</h2>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('employee.index', ['date' => date('Y-m')])}}">employees</a></li>
{{--                <a class="btn btn-sm btn-primary btn-round" href=""> Import</a>--}}
                @can('employee-import')
                <button type="button" class="btn btn-sm btn-primary btn-round" data-toggle="modal" data-target="#employeeImport">Import</button>
                @endcan
            </ul>
        </div>
    </div>
</div>
