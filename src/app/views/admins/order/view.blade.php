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
                    <a href="{{url('/admin/order/view?type=0')}}" class="btn btn-warning">ยังไม่จ่ายเงิน</a>
                    <a href="{{url('/admin/order/view?type=3')}}" class="btn btn-warning">ยังไม่จ่ายเงิน นานกว่า 1 วัน</a>
                    <a href="{{url('/admin/order/view?type=1')}}" class="btn btn-success">จ่ายเงินแล้ว</a>
                    <a href="{{url('/admin/order/view?type=2')}}" class="btn btn-danger">ยกเลิกแล้ว</a>
                    <a href="{{url('/admin/order/view?type=4')}}" class="btn btn-info">ทั้งหมด</a>
                    <table class="table table-striped">
                    	<thead>
                    		<tr>
                    			<th>#ID</th>
                    			<th>Name</th>
                    			<th>Time</th>
                                <th>View / Pay / Cancel</th>
                                <th>Type</th>
                    		</tr>
                    	</thead>
                    	<tbody>
		                    @foreach($orders as $order)
		                    <tr>
		                    	<td>{{$order['id']}}</td>
		                    	<td>{{$order['name']}}</td>
		                    	<td>{{$order['updated_at']}}</td>
                                <td>
                                    <a href="{{url('/admin/order/view/'. $order['id'])}}" class="btn btn-primary">ดูสินค้า</a>
                                    @if($order['type'] == 0)
                                    <a href="{{url('/admin/order/pay/'. $order['id'])}}" class="btn btn-success">จ่ายเงินแล้ว</a>
                                    <a href="{{url('/admin/order/cancel/'. $order['id'])}}" class="btn btn-danger">ยกเลิก Order</a>
                                    @endif
                                </td>
                                <td>
                                @if($order['type'] == 0)
                                <button class="btn btn-warning">Not pay</button>
                                @elseif($order['type'] == 1)
                                <button class="btn btn-success">Pay</button>
                                @elseif($order['type'] == 2)
                                <button class="btn btn-danger">Cancel</button>
                                @elseif($order['type'] == 3)
                                <button class="btn">Not pay > 1 day</button>
                                @endif
                                </td>       
		                    </tr>
		                    @endforeach
                    	</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin-nav')
    <!--/.span9-->
</div>
@stop