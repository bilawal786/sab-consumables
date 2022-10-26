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
    <h1 style="text-align: center; font-weight: 500;">Stock Report</h1>
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
        <th>Brand</th>
        <th>Remaining Stock</th>
        <th>Distribution</th>
        <th>Damages</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $damage)
        <tr>
            <td>{{$damage->brand->name}}</td>
            <td>{{$damage->quantity}}</td>
            <td>{{$damage->distribution}}</td>
            <td>{{$damage->damages}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<script type="text/javascript">
    window.onload = function() { window.print(); }
</script>
</body>
</html>
