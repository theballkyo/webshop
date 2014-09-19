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
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Size</th>
                            <th>Stock</th>
                            <th colspan="3" class="text-center">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product['size'] as $size)
                           <tr>
                                <td>{{$size['text']}}</td>
                                <td>{{$size['stock']}}</td>
                                <td><input type="text" size="2"><br>เพิ่ม</td>
                                <td><input type="text" size="2"><br>ลด</td>
                                <td><input type="text" size="2"><br>แก้ไข</td>
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