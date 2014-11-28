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
                    @if(!empty(Session::get('msg')))
                    <div class="alert warning">
                        <strong>ข้อความ :: </strong>
                        {{Session::get('msg')}}
                    </div>
                    @endif
                    <a href="{{url('/admin/order/new')}}" class="btn btn-warning">เพิ่ม Order ใหม่</a>
                    <hr>
                    <a href="{{url('/admin/order/view?type=6')}}" class="btn btn-warning">ยังไม่จ่ายเงิน</a>
                    <a href="{{url('/admin/order/view?type=5')}}" class="btn">ส่งแล้ว</a>
                    <a href="{{url('/admin/order/view?type=1')}}" class="btn btn-success">จ่ายเงินแล้ว</a>
                    <a href="{{url('/admin/order/view?type=2')}}" class="btn btn-danger">ยกเลิกแล้ว</a>
                    <a href="{{url('/admin/order/view?type=4')}}" class="btn btn-info">ทั้งหมด</a>
                    <br/><br/>
                    <a href="{{url('admin/order/print')}}" target="_blank" class="btn btn-success">Print orders</a>
                    <a href="{{url('admin/order/print/re')}}" target="_blank" class="btn btn-info">Reprint orders</a>
                    <br/>
                    <?php echo $orders->links(); ?>
                    <br/>
                    <table class="table table-striped table-bordered" id="vieworder">
                    	<thead>
                    		<tr>
                                <th width="2%">#ID</th>
                    			<th width="15%">Time</th>
                                <th width="5%">Source</th>
                    			<th width="25%">Name</th>
                                <th width="5%">SKU</th>
                                <th width="1%">Status</th>
                                <th width="10%">View / Edit</th>
                    		</tr>
                    	</thead>
                    	<tbody>
		                    @foreach($orders as $order)
		                    <tr>
                                <td>{{$order['id']}}</td>
		                    	<td>{{$order['updated_at']}}</td>
                                <td>{{$order['source']}}</td>
		                    	<td>{{$order['name']}}</td>
                                <td>
                                <?php $total = 0;?>
                                @foreach($products[$order['id']] as $pd)
                                    {{$pd['detail'][1]['data']['text']}}{{$pd['detail'][0]['data']['code']}} x {{$pd['amount']}} <br/>
                                <?php $total += $pd['price']; ?>
                                @endforeach
                                </td>
                                <td>
                                @if($order['type'] == 0)
                                <button class="btn btn-warning">ยังไม่จ่ายเงิน</button>
                                @elseif($order['type'] == 1)
                                <button class="btn btn-success">จ่ายเงินแล้ว</button>
                                @elseif($order['type'] == 2)
                                <button class="btn btn-danger">ยกเลิกแล้ว</button>
                                @elseif($order['type'] == 3)
                                <button class="btn">ส่งแล้ว</button>
                                @elseif($order['type'] == 5)
                                <button class="btn"></button>
                                @endif
                                </td>     
                                <td>
                                    <a href="{{url('/admin/order/view/'. $order['id'])}}" class="btn btn-primary">ดูสินค้า</a>
                                    @if($order['type'] == 0)
                                    <a href="{{url('/admin/order/cancel/'. $order['id'])}}" class="btn btn-danger">ยกเลิก</a>
                                    @endif
                                </td>  
		                    </tr>
		                    @endforeach
                    	</tbody>
                    </table>
                    <?php echo $orders->links(); ?>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin-nav')
    <!--/.span9-->
</div>
@stop
@section('script')
<script type="text/javascript">
$(document).ready(function(){
    var oTable = $('#vieworder').DataTable({
        "iDisplayLength" : 100,
        "order": [[ 0, "desc" ]]
    });
    a = $('#vieworder_filter input:text').val();
    //alert(a);
});
</script>
@stop