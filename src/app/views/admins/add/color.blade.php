@extends('layouts.admin')
@section('content')
<div class="row">
     @include('layouts.admin-nav')
     
<div class="span12">
        <div class="content">
            <div class="module">
                <div class="module-head">
                <h3>
                Welcome ,{{ Auth::user()->username }}</h3>
                </div>
                <div class="module-body">
                    @if(Session::has('msg'))
                    <div class="alert {{ Session::get('msg.type') }}">
                        <strong>Message :: </strong>
                        @if(Session::get('msg.type') == 'error')
                            ไม่สามารถทำการเพิ่มข้อมูลลงไปได้ เนื่องจากไม่มีสินค้าหลัก
                        @elseif(Session::get('msg.type') == 'success')
                            ทำการเพิ่มข้อมูลเรียบร้อยแล้ว
                        @elseif(Session::get('msg.type') == 'validator')
                            โปรดกรอกข้อมูลให้ถูกต้อง
                        @else
                            เกิดข้อผิดพลาดอื่นๆ โปรดติดต่อ Administrator
                        @endif
                    </div>
                    @endif

                    <form action="" method="post" class="form-horizontal row-fluid">
                        <div class="control-group">
                            <label class="control-label" for="color">Color *</label>              
                            <div class="controls">
                                <input id="color" name="color" type="text" class="span8">
                                @if($errors->has('color'))
                                <span class="help-inline alert">{{ $errors->first('color') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="color_hex">Color No.</label>              
                            <div class="controls">
                                <input id="color_hex" name="color_hex" type="text" class="span8">
                                @if($errors->has('color_hex'))
                                <span class="help-inline alert">{{ $errors->first('color_hex') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="color_img">Color Image</label>
                            <div class="controls">
                                <input id="color_img" name="color_img" type="text" class="span8">
                                @if($errors->has('color_img'))
                                <span class="help-inline alert">{{ $errors->first('color_img') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn btn-large btn-success">เพิ่มสี</button>
                            </div>
                        </div>
                        {{ Form::token() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/.span9-->
</div>
@stop