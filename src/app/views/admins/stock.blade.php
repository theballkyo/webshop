@extends('layouts.admin')
@section('content')
<div class="row">
     @include('layouts.admin-nav')
     <div class="span12">
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
                    <p>
                    <a href=" {{ url('admin/product/add/size/'. $product['id'])}} " class="btn btn-warning">เพิ่ม Size สินค้า</a>
                    </p>
                    <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th style="width:5%" class="text-center">Size</th>
                            <th style="width:10%" class="text-center">SKU</th>
                            <th style="width:10%" class="text-center">Stock</th>
                            <th class="text-center">Price</th>
                            <th colspan="3" class="text-center">Edit</th>
                            <th style="width:10%" class="text-center">Show</th>
                            <th class="text-center">Reserve</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product['size'] as $size)
                           <tr id="{{$size['id']}}">
                                <td>{{$size['text']}}</td>
                                <td>{{$size['text']}}{{$product['color']}}</td>
                                <td>{{$size['stock']}}</td>
                                <form method="post" class="form-horizontal row-fluid">
                                <td><input autocomplete="off" name="price" type="text" value="{{$size['price']}}" class="span1">
                                    <button type="submit" class="btn btn-primary">แก้ไข</button>
                                </td>
                                {{ Form::token() }}
                                <input type="hidden" name="size_id" value="{{$size['id']}}">
                                </form>

                                <form method="post" class="form-horizontal row-fluid">
                                <td><input autocomplete="off" name="add" type="text" value="0" class="span1">
                                    <button type="submit" class="btn btn-primary">เพิ่ม</button>
                                </td>
                                {{ Form::token() }}
                                <input type="hidden" name="size_id" value="{{$size['id']}}">
                                </form>

                                <form method="post" class="form-horizontal row-fluid">
                                <td><input autocomplete="off" name="del" type="text" value="0" class="span1">
                                    <button type="submit" class="btn btn-primary">ลด</button>
                                </td>
                                {{ Form::token() }}
                                <input type="hidden" name="size_id" value="{{$size['id']}}">
                                </form>

                                <form method="post" class="form-horizontal row-fluid">
                                <td><input autocomplete="off" name="update" type="text" value="{{$size['stock']}}" class="span1">
                                    <button type="submit" class="btn btn-primary">แก้ไข</button>
                                </td>
                                {{ Form::token() }}
                                <input type="hidden" name="size_id" value="{{$size['id']}}">
                                </form>

                                <td>
                                    <form method="post" class="form-horizontal row-fluid">
                                    <label class="checkbox inline">
                                    <input type="hidden" name="show" value="0" />
                                    <input name="show" type="checkbox" value="1" onChange="this.form.submit()"
                                    {{ $size['show'] == '1' ? 'checked' : ''}} />
                                        Show ?
                                    </label>
                                    <input type="hidden" name="size_id" value="{{$size['id']}}">
                                    {{ Form::token() }}
                                    </form>
                                </td>
                                <td>
                                    <a class="btn" href="{{url('admin/stock/reserve/'.$size['code'].'')}}">จองสินค้านี้</a>
                                </td>
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