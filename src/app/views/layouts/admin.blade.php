<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sommai - Admin CP</title>
        <link type="text/css" href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link type="text/css" href="{{asset('bootstrap/css/bootstrap-responsive.min.css')}}" rel="stylesheet">
        <link type="text/css" href="{{asset('css/theme.css')}}?ver=1002" rel="stylesheet">
        <link type="text/css" href="{{asset('images/icons/css/font-awesome.css')}}" rel="stylesheet">
        <link type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="{{asset('js/select2.css')}}" rel="stylesheet"/>
        <link type="text/css" href='//fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="{{ url('/admin') }}">Sommai</a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav nav-icons">
                        </ul>
                        <form class="navbar-search pull-left input-append" action="#">
                        <input type="text" class="span3">
                        <button class="btn" type="button">
                            <i class="icon-search"></i>
                        </button>
                        </form>
                        <ul class="nav pull-right">
                            <li class="nav-user">
                                <a href="{{ url('/admin/order/new') }}">New Orders</a>
                            </li>
                            <li class="nav-user">
                                <a href="{{ url('/admin/order/view') }}">View Orders</a>
                            </li>
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Main Menu<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/admin') }}"><i class="menu-icon icon-dashboard"></i>Dashboard
                                    </a></li>
                                    <li><a href="{{ url('/admin/customer') }}"><i class="menu-icon icon-dashboard"></i>Customer
                                    </a></li>
                                    <li><a href="{{ url('/admin/reserve') }}"><i class="menu-icon icon-dashboard"></i>Reserve
                                    </a></li>
                                    <li><a href="{{url('/admin/stocks')}}"><i class="menu-icon icon-inbox"></i>Stocks<b class="label green pull-right">
                                    -</b> </a></li>
                                    <li><a href="{{url('/user/logout')}}"><i class="menu-icon icon-tasks"></i>Logout</a></li>
                                </ul>
                            </li>

                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{asset('images/user.png')}}" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Your Profile</a></li>
                                    <li><a href="#">Edit Profile</a></li>
                                    <li><a href="#">Account Settings</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{url('/user/logout')}}">Logout</a></li>
                                </ul>
                            </li>
                            <li class="clock"><a href="#"><div id="clockbox"></div>
                            </a></li>
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                @yield('content')
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <div class="footer">
            <div class="container">
                <b class="copyright">&copy; 2014 Sommai </b>All rights reserved. Version :: 0.9.2 beta
                <p>{{PHP_Timer::resourceUsage()}}</p>
            </div>
        </div>
        <script src="{{asset('scripts/jquery-1.9.1.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('scripts/jquery-ui-1.10.1.custom.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
        <script src="{{asset('js/select2.min.js')}}"></script>
        <!--
        <script src="{{asset('scripts/flot/jquery.flot.js')}}" type="text/javascript"></script>
        <script src="{{asset('scripts/flot/jquery.flot.resize.js')}}" type="text/javascript"></script>
        <script src="{{asset('scripts/common.js" type="text/javascript')}}"></script>
        <script src="{{asset('scripts/datatables/jquery.dataTables.js')}}" type="text/javascript"></script>
        -->
        <script type="text/javascript">
        function GetClock(){
            tzOffset = {{date('Z')/60/60}};//set this to the number of hours offset from UTC

            d = new Date();
            dx = d.toGMTString();
            dx = dx.substr(0,dx.length -3);
            d.setTime(Date.parse(dx))
            d.setHours(d.getHours() + tzOffset);

            nday   = d.getDay();
            nmonth = d.getMonth();
            ndate  = d.getDate();
            nyear = d.getYear();
            nhour  = d.getHours();
            nmin   = d.getMinutes();
            nsec   = d.getSeconds();

            if(nyear<1000) nyear=nyear+1900;

                 if(nhour ==  0) {ap = " AM";nhour = 12;} 
            else if(nhour <= 11) {ap = " AM";} 
            else if(nhour == 12) {ap = " PM";} 
            else if(nhour >= 13) {ap = " PM";nhour -= 12;}

            if(nmin <= 9) {nmin = "0" +nmin;}
            if(nsec <= 9) {nsec = "0" +nsec;}


            document.getElementById('clockbox').innerHTML=""+ndate+"/"+(nmonth+1)+"/"+nyear+" "+nhour+":"+nmin+":"+nsec+ap+"";
            setTimeout(function(){GetClock()}, 1000); 

            }
            window.onload=GetClock;
        </script>
        @yield('script')
      
    </body>