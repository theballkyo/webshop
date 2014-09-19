<!doctype html>
<html>
<head><link rel="shortcut icon" href="{{ asset('image/logo2.ico') }}" />
	<title>สมหมายขายกางเกง</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('jqweryui/qwery-ui.css') }}">
	<script type="text/javascript" src="{{ asset('jqweryui/jqwery-ui.js') }}"></script>


</head>
<body>
	<div id="navbar">
		<ul id="item">
			<li>Hello, {{ Auth::check() ? Auth::user()->username : 'Guest' }}</li>
			<li><img src=" {{ asset('image/logo.jpg') }}" id="som"/></li>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('/shop') }}">Shop</a></li>
            @if(Auth::check())
            <li><a href="{{ url('user/logout') }}">Logout</a>
            @if(Auth::user()->status == 1)
            <li><a href="{{ url('admin') }}">Admin Panel</a></li>
            @endif
            @else
            <li><a href="{{ url('user/login') }}">Login</a></li>
            <li><a href="{{ url('user/register') }}">Signup</a></li>
            @endif
            
      </ul>
  </div>
            </li>

	<div id="img-top">
		<div id="caption">
			<h1 class="title">Make สมหมาย!</h1>
			<p class="caption-top">
				กางเกงขาสั้น ที่ตอบโจทย์คุณ ไม่ว่าจะเป็นสี ตะเข็บ เนื้อผ้า ที่จะทำให้การสวมใส่ของคุณนั้น
				รู้สึกสบายถึงขีดสุด
			</p>
			<div id="buybutton"><a href="#shop">Buy Sommai</a></div>
		</div>
	</div>
	

    <div class="container marketing" id="feature">
      @yield('content')
      <hr class="featurette-divider" id="linethree">
      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy;  Sommai 2014 Company, Inc. &middot; <a href="{{ url('privacy')}}">Privacy</a> &middot;
          <a href="{{ url('terms') }}">Terms</a></p>
      </footer>

    </div>
</body>
</html>