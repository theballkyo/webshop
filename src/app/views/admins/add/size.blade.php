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
                    <div class="alert {{ Session::get('msg.type') }}">
                    	<strong>คำแนะนำ :: </strong>
                    	การเพิ่ม size สินค้านี้จะทำการเพิ่มไปยังทุกสีของรายการสินค้านี้ แต่คุณสามารถสั่งไม่ให้โชว์ได้ในหน้าตรวจสอบ stock
                    </div>
                    <form action="" method="post" class="form-horizontal row-fluid">
                        <div class="control-group">
                            <label class="control-label" for="size">Size *</label>              
                            <div class="controls">
                                <input id="size" name="size" type="text" class="span8">
                                @if($errors->has('size'))
                                <span class="help-inline alert">{{ $errors->first('size') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn btn-large btn-success">เพิ่ม size</button>
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