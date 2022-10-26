<html>
<head>
<style>
    body{
        margin: 50px;
        font-family: "Roboto", "Helvetica Neue", "Helvetica", "Arial";
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin:50px auto;
    }

    /* Zebra striping */
    tr:nth-of-type(odd) {
        background: #eee;
    }

    th {
        background: #3498db;
        color: white;
        font-weight: bold;
    }

    td, th {
        padding: 10px;
        border: 1px solid #ccc;
        text-align: left;
        font-size: 13px;
        word-wrap: break-word;
    }

    /*
    Max width before this PARTICULAR table gets nasty
    This query will take effect for any screen smaller than 760px
    and also iPads specifically.
    */


</style>
</head>
<body>
<div>
    <h1 style="text-align: center; font-weight: 500;">Distribution Report</h1>
</div>
<div style="float: none;">
    <div style="float: left;">
        <?php
        $setting = \App\Models\Settings::first();
        ?>
        <img src="{{asset($setting->logo1)}}" style="width:130px; margin: 20px;" />
        <h3 style="margin: 20px;">{{$setting->title}}</h3>
    </div>
    <div style="float: right;">
        <h3 style="margin: 20px;">Date: <span>{{$date}}</span></h3>
    </div>
</div>
<table  style="table-layout: fixed;">
    <thead>
    <tr>
        <th>Employee No.</th>
        <th>Surname</th>
        <th>Paypoint</th>
        <th>Selection 1</th>
        <th>Selection 2</th>
        <th>Brands.</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $distribution)
        <tr>
            <td>{{$distribution->employee->employee_no}}</td>
            <td>{{$distribution->employee->surname}}</td>
            <td>{{$distribution->employee->paypoint}}</td>
            <td>{{$distribution->employee->selection_1}}</td>
            <td>{{$distribution->employee->selection_2}}</td>
            @php
                $brands = \App\Models\Distrebution::with('brand')->where('employee_id', $distribution->employee_id)->get();
            @endphp
            <td>
                @foreach($brands as $brand)
                    <span>{{$brand->brand->name}}</span>,
                @endforeach
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<script type="text/javascript">
    window.onload = function() { window.print(); }
</script>
</body>
</html>
