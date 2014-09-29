@extends('layouts.ubase')
@section('content')
<div class="row">
    <div class="col-lg-12 text-center" id="col1">
      <h1>Hello, {{ Auth::check() ? Auth::user()->username : 'Guest' }}</h1>
	@if(!Auth::check())
		<a href="{{ url('user/login') }}">Login</a> 
		or
		<a href="{{ url('user/register')}}">Register</a>
	@else
		<a href="{{ url('user/logout') }}">Logout</a>
	@endif
	</div>
</div><!-- /.row -->
@stop