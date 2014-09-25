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
                    <h2>New Customer</h2>
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        <strong>Message :: </strong>
                        ทำการเพิ่มข้อมูลเรียบร้อยแล้ว
                    </div>
                    @elseif($errors->has('name'))
                    <div class="alert alert-error">
                        <strong>Message :: </strong>
                        โปรดกรอกข้อมูลให้ถูกต้อง
                    </div>
                    @endif
                    <form class="form-horizontal row-fluid" method="post">
                        <div class="control-group">
                            <label class="control-label" for="basicinput">Name</label>
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