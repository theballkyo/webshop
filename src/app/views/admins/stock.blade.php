@extends('layouts.admin')
@section('content')
<div class="row">
     @include('layouts.admin-nav')
     <div class="span9">
        <div class="content">
            <div class="module">
                <div class="module-head">
                <h3>
                Welcome Eiei,{{ Auth::user()->username }}</h3>
                </div>
                <div class="module-body">
                    @if(Session::has('msg.type'))
                        <div class="alert error">
                            <strong>Message :: </strong>
                            ใส่ได้เฉพาะตัวเลข 0-9 เท่านั้น !
                        </div>
                    @endif
                    <a href=" {{ url('admin/product/'. $product['id'] .'/'. $product['color'] .'/add/size/')}} " class="btn btn-warning">เพิ่ม Size สินค้า</a>
                    <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th style="width:10%">Size</th>
                            <th style="width:10%">Stock</th>
                            <th colspan="4" class="text-center">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product['size'] as $size)
                           <tr id="{{$size['id']}}">
                                <td>{{$size['text']}}</td>
                                <td>{{$size['stock']}}</td>
                                <form method="post" class="form-horizontal row-fluid">
                                <td><input name="add" type="text" value="0" class="span1">
                                    <button type="submit" class="btn btn-primary">เพิ่ม</button>
                                </td>
                                {{ Form::token() }}
                                <input type="hidden" name="size_id" value="{{$size['id']}}">
                                </form>
                                <form method="post" class="form-horizontal row-fluid">
                                <td><input name="del" type="text" value="0" class="span1">
                                    <button type="submit" class="btn btn-primary">ลด</button>
                                </td>
                                {{ Form::token() }}
                                <input type="hidden" name="size_id" value="{{$size['id']}}">
                                </form>
                                <form method="post" class="form-horizontal row-fluid">
                                <td><input name="update" type="text" value="{{$size['stock']}}" class="span1">
                                    <button type="submit" class="btn btn-primary">แก้ไข</button>
                                </td>
                                {{ Form::token() }}
                                <input type="hidden" name="size_id" value="{{$size['id']}}">
                                </form>
                                <td>Delete</td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/.span9-->
</div>
@stop