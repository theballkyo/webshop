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
                    <h2><a href="#" class="btn btn-primary btn-large">เพิ่มสินค้าใหม่</a></h2>
                    <hr>
                    @foreach($products as $product)
                        <h3>Name : {{$product['name']}}</h3>
                        <a href=" {{ url('admin/product/add/color/'. $product['id'])}} " class="btn btn-warning">เพิ่มสีสินค้า</a>
                        <a href=" {{ url('admin/product/add/size/'. $product['id'])}} " class="btn btn-warning">เพิ่ม Size สินค้า</a>
                        <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Color</th>
                                <th style="width:20%;">Image</th>
                                <th>Stock</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product['detail']['datas'] as $color)
                            <tr>
                                <td><strong>{{$color['text']}}</strong></td>
                                <td>{{ empty($color['imgurl']) ? '' : '<a target="_blank" href="'. $color['imgurl'] . '"><img src="'. $color['imgurl'] .'"></a>'}}</td>
                                <td><a href="{{ url('admin/stock/get/'. $product['id'] .'/'. $color['id']) }}"> ตรวจสอบ Stock</a></td>
                                <td>
                                    <form method="post" action="{{url('admin/stock/delete/'.$color['id'])}}"
                                    onsubmit="return confirm('คุณต้องการลบสีนี้หรือเปล่า ?');">
                                    <button class="btn btn-inverse">Delete</button>
                                    {{Form::token()}}
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--/.span9-->
</div>
@stop