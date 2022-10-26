@php
    $setting = \App\Models\Settings::first();
@endphp
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="{{asset($setting->logo2)}}" width="48" height="48" alt="HexaBit">
        </div>
        <p>Please wait...</p>
    </div>
</div>
