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
                    @foreach($products as $product)
                        <h3>Name : {{$product['name']}}</h3><a href=" {{ url('admin/product/'. $product['id'] .'/add/color')}} " class="btn btn-warning">เพิ่มสีสินค้า</a>
                        <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Color</th>
                                <th>Stock</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product['detail']['datas'] as $color)
                            <tr>
                                <td><strong>{{$color['text']}}</strong></td>
                                <td><a href="{{ url('admin/stock/'. $product['id'] .'/'. $color['id']) }}"> ตรวจสอบ Stock</a></td>
                                <td><a href="{{url('admin/stock/delete/'. $product['id'] .'/'. $color['id']) }}">Delete</a></td>
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