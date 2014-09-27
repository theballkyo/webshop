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
                    <h2>Customer product reserve</h2>
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        <strong>Message :: </strong>
                        ทำการอัพเดทข้อมูลเรียบร้อยแล้ว
                    </div>
                    @elseif($errors->has('name'))
                    <div class="alert alert-error">
                        <strong>Message :: </strong>
                        โปรดกรอกข้อมูลให้ถูกต้อง
                    </div>
                    @endif
                    <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th style="width:1" class="text-center">Product name</th>
                            <th style="width:20%" class="text-center">Color</th>
                            <th class="text-center">Size</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Cancel</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($cus_reserve as $reserve)
                        <tr>
                            <td>{{$reserve['product']['name']}}</td>
                            @foreach($reserve['product']['detail'] as $detail)
                            <td>{{$detail['data']['text']}}</td>
                            @endforeach
                            <td>{{$reserve['amount']}}</td>
                            <td><a href="{{url('admin/stock/reserve/cancel/'.$reserve['id'].'')}}">Cancel</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                    <h2>Customer profile</h2>
                    <form class="form-horizontal row-fluid" method="post" 
                                onsubmit="return confirm('คุณต้องการแก้ไขข้อมูลนี้หรือไม่ ?');">
                        <div class="control-group">
                            <label class="control-label" for="basicinput">Name</label>
                            <div class="controls">
                                <input name="name" value="{{$cus_user->name}}" type="text" id="basicinput" placeholder="" class="span8">
                                @if($errors->has('name'))
                                <span class="help-inline alert">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="basicinput">Address</label>
                            <div class="controls">
                                <textarea name="address" class="span8" rows="3">{{$cus_user->address}}</textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="basicinput">Email</label>
                            <div class="controls">
                                <input name="email" value="{{$cus_user->email}}" type="text" id="basicinput" placeholder="" class="span8">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="basicinput">Tel.</label>
                            <div class="controls">
                                <input name="tel" value="{{$cus_user->tel}}" type="text" id="basicinput" placeholder="" class="span8">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="basicinput">Note</label>
                            <div class="controls">
                                <textarea name="note" class="span8" rows="3">{{$cus_user->note}}</textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn btn-info btn-large">Edit profile</button>
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
