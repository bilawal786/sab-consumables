@php
    $setting = \App\Models\Settings::first();

        //$today= Carbon\Carbon::now();
       // echo $today->year.'-'.$today->month;


@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mail</title>
    <style>
        table{
            width: 100%;
            font-family: lato, 'helvetica neue', helvetica, arial, sans-serif;
        }
        .button-a {
            background-color: #28a745;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 50px;
        }
        .button-d {
            background-color: #ffc107;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 50px;
        }


    </style>
</head>
<body>
<table>
    <tr style="background-color: #ec2c2f; color: #ffffff">
        <td style="text-align: center">
            <h1>Damages!</h1>
        </td>
    </tr>
    <tr>
        <td  style="text-align: center;">
            <img style="margin-top: 20px" src="{{asset($setting->logo1)}}" alt="">
        </td>
    </tr>
</table>
@foreach($details as $item)
    <table style="margin-top: 20px">
        <tr>
            <td style="text-align: center">
                <table style="width:600px !important" align="center">
                    <tr>
                        <td>
                            <h3>Details</h3>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:5px">
                            Date:
                        </td>
                        <td style="padding:5px">
                            {{$item->date}}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:5px">
                            Brand
                        </td>
                        <td style="padding:5px">
                            {{$item->brand->name}}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:5px">
                            Quantity
                        </td>
                        <td style="padding:5px">
                            {{$item->quantity}}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:5px">
                            Add by
                        </td>
                        <td style="padding:5px">
                            {{$item->user->first_name.' '.$item->user->last_name}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endforeach
<table style="background-color: #ec2c2f; color: #ffffff">
<tr>
    <td style="text-align: center; padding:20px">
        <a target="_blank" href="{{route('email.damage.accept', ['id' => json_encode($ids)])}}"> <button class="button-a">Accept</button></a>
        <a target="_blank" href="{{route('email.damage.decline', ['id' =>json_encode($ids)])}}"> <button class="button-d">Decline</button></a>
    </td>
</tr>
</table>
<table style="margin-top: 20px">
    <tr>
        <td style="text-align: center"><h3>Yummy Box</h3></td>
    </tr>
</table>

</body>
</html>
