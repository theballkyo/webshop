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
                    @if(Session::has('msg.type'))
                        <div class="alert error">
                            <strong>Message :: </strong>
                            ใส่ได้เฉพาะตัวเลข 0-9 เท่านั้น !
                        </div>
                    @endif
                    <a href=" {{ url('admin/product/'. $product['id'] .'/'. $product['color'] .'/add/size/')}} " class="btn btn-warning">เพิ่ม Size สินค้า</a>
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Size</th>
                            <th>Stock</th>
                            <th colspan="4" class="text-center">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product['size'] as $size)
                           <tr id="{{$size['id']}}">
                                <td>{{$size['text']}}</td>
                                <td>{{$size['stock']}}</td>
                                <form method="post">
                                <td><input name="add" type="text" value="0"><br>
                                    <button type="submit" class="btn btn-primary">เพิ่ม</button>
                                </td>
                                <td><input name="del" type="text" value="0"><br>
                                    <a href="#" class="btn btn-primary">ลด</a>
                                </td>
                                <td><input name="update" type="text" value="{{$size['stock']}}"><br>
                                    <a href="#" class="btn btn-primary">แก้ไข</a>
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
    <!--/.span9-->
</div>
@stop