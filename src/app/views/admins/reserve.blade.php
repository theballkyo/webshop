@extends('layouts.admin')
@section('content')
<div class="row">
	 @include('layouts.admin-nav')
	 <div class="span9">
		<div class="content">
			<div class="module">
				<div class="module-head">
				<h3>
				Welcome ,{{ Auth::user()->username }}</h3>
				</div>
				<div class="module-body">
					@if(Session::has('success'))
					<div class="alert success">
						<strong>Message :: </strong>
						ทำการจองเรียบร้อยแล้ว
					</div>
					@endif
					<form action="" method="post" class="form-horizontal row-fluid">
						<div class="control-group">
							<label class="control-label" for="amount">Amount *</label>              
							<div class="controls">
								<input id="amount" name="amount" type="text" class="span8">
								@if($errors->has('amount'))
								<span class="help-inline alert">{{ $errors->first('amount') }}</span>
								@elseif(Session::has('stock'))
								<span class="help-inline alert">จำนวนStockมีไม่พอกับจำนวนที่จะจอง</span>
								@endif
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="reserve_note">Note</label>
							<div class="controls">
								<input id="reserve_note" name="reserve_note" type="text" class="span8">
							</div>
						</div>
						<div class="control-group">
						<label class="control-label">รายชื่อลูกค้าเก่า</label>
							<div class="controls">
								<select name="old_cus" tabindex="1" data-placeholder="ลูกค้าเก่า" class="span8">
									<option value="">หากเป็นลูกค้ารายใหม่ให้เลือกอันนี้แล้วไปกรอกข้อมูลด้านล่าง</option>
									@foreach($cus_users as $cus_user)
									<option value="{{$cus_user['id']}}"
									{{Input::old('old_cus') == $cus_user['id']? 'selected="selected"':''}}>
										{{$cus_user['name']}}
										Email::{{$cus_user['email']}}
										Tel::{{$cus_user['tel']}}
									</option>
									@endforeach
								</select>
							</div>
						</div>
						<hr>
					<p><h2>เพิ่มข้อมูลลูกค้าใหม่</h2></p>
						<div class="control-group">
							<label class="control-label" for="basicinput">Name *</label>
							<div class="controls">
								<input name="name" type="text" id="basicinput" placeholder="" class="span8">
								@if($errors->has('name'))
								<span class="help-inline alert">{{ $errors->first('name') }}</span>
								@endif
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="basicinput">Address</label>
							<div class="controls">
								<textarea name="address" class="span8" rows="3"></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="basicinput">Email</label>
							<div class="controls">
								<input name="email" type="text" id="basicinput" placeholder="" class="span8">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="basicinput">Tel.</label>
							<div class="controls">
								<input name="tel" type="text" id="basicinput" placeholder="" class="span8">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="basicinput">Note</label>
							<div class="controls">
								<textarea name="note" class="span8" rows="3">Created By Admin</textarea>
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<button type="submit" class="btn btn-info btn-large">Add customer</button>
							</div>
						</div>
						{{Form::token()}}
					</form>
				</div>
			</div>
		</div>
	</div>
	<!--/.span9-->
</div>
@stop