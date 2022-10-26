@php
    $setting = \App\Models\Settings::first();

        //$today= Carbon\Carbon::now();
       // echo $today->year.'-'.$today->month;

@endphp
<div id="left-sidebar" class="sidebar">
    <div class="navbar-brand">
        <a href="{{route('dashboard.index')}}"><img src="{{asset($setting->logo1)}}" alt="{{$setting->name}} Logo" class="img-fluid logo"><span>{{$setting->name}}</span></a>
        <button type="button" class="btn-toggle-offcanvas btn btn-sm btn-default float-right"><i class="lnr lnr-menu fa fa-chevron-circle-left"></i></button>
    </div>
    <div class="sidebar-scroll">
        <div class="user-account">
            <div class="user_div">
                <img src="{{asset(Auth::user()->user_image)}}" class="user-photo" style="width: 86px; height: 86px;" alt="User Profile Picture">
            </div>
            <div class="dropdown">
                <span>Welcome,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>{{Auth::user()->first_name.' '.Auth::user()->last_name}}</strong></a>
                <ul class="dropdown-menu dropdown-menu-right account">
                    <li><a href="{{route('profile.index')}}"><i class="icon-user"></i>My Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-power"></i>Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">
                <li class="{{ request()->is('dashboard') || request()->is('/') ? 'active' : '' }}">
                    <a href="{{route('dashboard.index')}}"><i class="icon-home"></i><span>Dashboard</span></a>
                </li>
                @can('brand-list')
                <li class="{{ request()->is('brands*') ? 'active' : '' }}">
                    <a href="{{route('brands.index')}}"><i class="fa fa-list"></i><span>Brands</span></a>
                </li>
                @endcan
                @can('stock-list')
                <li class="{{ request()->is('stocks*') ? 'active' : '' }}">
                    <a href="{{route('stocks.index', ['date' => date('Y-m')])}}"><i class="fa fa-dropbox"></i><span>Stock</span></a>
                </li>
                @endcan
                @can('employee-list')
                <li class="{{ request()->is('employee*') ? 'active' : '' }}">
                    <a href="{{route('employee.index', ['date' => date('Y-m')])}}"><i class="fa fa-users"></i><span>Employees</span></a>
                </li>
                @endcan
                @can('distribution')
                <li class="{{ request()->is('distribution*') ? 'active' : '' }}">
                    <a href="{{route('distribution.index', ['date' => date('Y-m')])}}"><i class="fa fa-industry"></i><span>Distribution</span></a>
                </li>
                @endcan
                @can('damages-list')
                <li class="{{ request()->is('damages*') ? 'active' : '' }}">
                    <a href="{{route('damages.index', ['date' => date('Y-m')])}}"><i class="fa fa-chain-broken"></i><span>Damages</span></a>
                </li>
                @endcan
                <li class="{{ request()->is('distributereports*') || request()->is('stockreport*') ? 'active' : '' }}">
                    <a href="#reports"><i class="fa fa-file"></i><span>Reports</span><i class="fa fa-angle-down float-right"></i></a>
                    <ul aria-expanded="false" class="collapse">
                        @can('distribution-report-list')
                        <li class="{{ request()->is('distributereports*') ? 'active' : '' }}"><a href="{{route('distributereports.index', ['date' => date('Y-m')])}}">Distribution Report</a></li>
                        @endcan
                        @can('stock-report-list')
                        <li class="{{ request()->is('stockreport*') ? 'active' : '' }}"><a href="{{route('stockreport.index', ['date' => date('Y-m')])}}">Stock Report</a></li>
                        @endcan
                    </ul>
                </li>
                <li class="{{ request()->is('profile*') || request()->is('users*') || request()->is('roles*') || request()->is('settings*') ? 'active' : '' }}">
                    <a href="#forms" class="has-arrow"><i class="icon-settings"></i><span>Settings<i class="fa fa-angle-down float-right"></i></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li class="{{ request()->is('profile*') ? 'active' : '' }}"><a href="{{route('profile.index')}}">Profile</a></li>
                        @can('user-list')
                        <li class="{{ request()->is('users*') ? 'active' : '' }}"><a href="{{route('users.index')}}">Users</a></li>
                        @endcan
                        @can('role-list')
                        <li class="{{ request()->is('roles*') ? 'active' : '' }}"><a href="{{route('roles.index')}}">Roles</a></li>
                        @endcan
                        @can('setting')
                        <li class="{{ request()->is('settings*') ? 'active' : '' }}"><a href="{{route('settings.index')}}">Settings</a></li>
                        @endcan
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
