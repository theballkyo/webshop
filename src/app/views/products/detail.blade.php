@extends('layouts.ubase')
@section('content')
{{ Session::get('error') }}
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

	@foreach($pd_data as $data)
		{{ $data['name'] }}
		@foreach($data['data'] as $dat)
			@if(empty($dat['imgurl']))
				{{ $dat['text'] }}
			@else
				{{ $dat['text'] }}
			@endif
		@endforeach
	@endforeach
	</div>
	<pre>
	<?php print_r ($pd_data); ?>
</div><!-- /.row -->
@stop