@extends('layouts.admin')
@section('content')
<div class="row">
     
     <div class="span12">
        <div class="content">
            <div class="module">
                <div class="module-head">
                <h3>
                Welcome ,{{ Auth::user()->username }}</h3>
                </div>
                <div class="module-body">
                    <div class="alert warning">
                        <strong>Warning :: </strong>
                        ขณะนี้กำลังอยู่ช่วงทดสอบระบบอยู่อาจมีปัญหาบางอย่าง !
                    </div>
                    <h3>ยินดีต้อนรับสู่ Sommai Stock Manager</h3>
                    *Note ลบข้อมูลลูกค้ายังทำไม่เสร็จ
                    <hr>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Name</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Price / Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0;$i=1 ?>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$product['name']}}</td>
                                <td>{{$product['detail'][1]['data']['text']}}</td>
                                <td>{{$product['detail'][0]['data']['text']}}</td>
                                <td>{{$product['price']}} บาท / {{$product['amount']}} ชิ้น</td>
                            </tr>
                            <?php
                            $total += $product['price'] * $product['amount'];$i++;
                            ?>
                            @endforeach
                        </tbody>
                    </table>
                    Total Price :: {{$total}} บาท <br/>
                    Name :: {{$order['name']}} <br/>
                    Address :: {{$order['address']}} </br>
                    Tel :: {{$order['tel']}} </br>
                    @if($order['type'] == 0)
                    <a href="{{url('/admin/order/pay/'. $order['id'])}}" class="btn btn-warning">จ่ายเงินแล้ว</a>
                    <a href="{{url('/admin/order/cancel/'. $order['id'])}}" class="btn btn-danger">ยกเลิก Order</a>
                    @elseif($order['type'] == 1)
                    <button class="btn btn-success">Order นี้ชำระเงินเรียบร้อยแล้ว</button>
                    @elseif($order['type'] == 2)
                    <button class="btn btn-danger">Order นี้ยกเลิกเรียบร้อยแล้ว</button>
                    
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin-nav')
    <!--/.span9-->
</div>
@stop