@extends('layouts.ubase')
@section('content')
<div class="row">
  <div class="col-lg-12 text-center" id="col1">
    <form method="post" class="form-horizontal" role="form">
      <div class="form-group">
        <label for="username" class="col-sm-2 control-label">username</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="username" placeholder="Username">
        </div>
      </div>
      <div class="form-group">
        <label for="password" class="col-sm-2 control-label">password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
      </div>
  		<input type="submit" value="เข้าสู่ระบบ">
  	  {{ Form::token() }}
	</form>
  </div>
</div>
@stop
