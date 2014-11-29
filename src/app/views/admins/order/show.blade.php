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
                    @if($order['type'] == 0)
                    <a href="{{url('/admin/order/add/'. $order_id)}}" class="btn btn-info">เพิ่มสินค้า</a>
                    <a href="{{url('/admin/order/pay/'. $order_id)}}" class="btn btn-success">จ่ายเงินแล้ว</a>
                    <a href="{{url('/admin/order/cancel/'. $order_id)}}" class="btn btn-danger">ยกเลิก Order</a>
                    <a href="{{url('/admin/order/cancel/'. $order_id)}}" class="btn btn-danger">รอของมา</a>
                    @elseif($order['type'] == 1)
                    <button class="btn btn-success">Order นี้ชำระเงินเรียบร้อยแล้ว</button>
                    @elseif($order['type'] == 2)
                    <button class="btn btn-danger">Order นี้ยกเลิกเรียบร้อยแล้ว</button>
                    
                    @endif
                    <hr>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>SKU</th>
                                <th>Name</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Price / Amount</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0;$i=1 ?>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$product['detail'][1]['data']['text']}}{{$product['detail'][0]['data']['code']}} x 
                                    {{$product['amount']}}
                                </td>
                                <td>{{$product['name']}}</td>
                                <td>{{$product['detail'][1]['data']['text']}}</td>
                                <td>{{$product['detail'][0]['data']['text']}}</td>
                                <td>{{$product['price']}} บาท / {{$product['amount']}} ชิ้น</td>
                                <td><a class="btn btn-danger" href="{{url('/admin/order/cancelr/'.$order_id.'/'.$product['rid'])}}">Delete</a></td>
                            </tr>
                            <?php
                            $total += $product['price'] * $product['amount'];$i++;?>
                            @endforeach
                            <tr>
                                <td colspan="6" class="black"></td>
                                <td class="black">Total Price {{$total}} บาท</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <form class="form-horizontal row-fluid" method="post">

                        <div class="control-group">
                            {{Form::label('status', 'สถานะ', ['class' => 'control-label'])}}
                            <div class="controls">
                                <select name="status" tabindex="1" data-placeholder="สถานะ" class="span11">
                                    <option value="0" {{$order['type'] == 0 ? 'selected' : ''}}>รอจ่ายเงิน</option>
                                    <option value="1" {{$order['type'] == 1 ? 'selected' : ''}}>จ่ายเงินแล้ว</option>
                                    <option value="2" {{$order['type'] == 2 ? 'selected' : ''}}>ยกเลิก Order</option>
                                    <option value="3" {{$order['type'] == 3 ? 'selected' : ''}}>ส่งแล้ว</option>
                                    <option value="5" {{$order['type'] == 5 ? 'selected' : ''}}>รอของมา</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            {{Form::label('shipping', 'Shipping', ['class' => 'control-label'])}}
                            <div class="controls">
                                <select name="shipping" tabindex="1" data-placeholder="shipping" class="span11">
                                    <option value="1" {{$order['shipping'] == 1 ? 'selected' : ''}}>EMS</option>
                                    <option value="2" {{$order['shipping'] == 2 ? 'selected' : ''}}>Register</option>
                                    <option value="3" {{$order['shipping'] == 3 ? 'selected' : ''}}>รับเอง</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="basicinput">Name</label>
                            <div class="controls">
                                <input name="name" value="{{$order['name']}}" type="text" id="basicinput" placeholder="" class="span8">
                                @if($errors->has('name'))
                                <span class="help-inline alert">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="basicinput">Address</label>
                            <div class="controls">
                                <textarea name="address" class="span8" rows="3">{{$order['address']}}</textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="basicinput">Email</label>
                            <div class="controls">
                                <input name="email" value="{{$order['email']}}" type="text" id="basicinput" placeholder="" class="span8">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="basicinput">Tel.</label>
                            <div class="controls">
                                <input name="tel" value="{{$order['tel']}}" type="text" id="basicinput" placeholder="" class="span8">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="basicinput">Note</label>
                            <div class="controls">
                                <textarea name="note" class="span8" rows="3">{{$order['note']}}</textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn btn-info btn-large">แก้ไข</button>
                            </div>
                        </div>
                        {{Form::token()}}
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin-nav')
    <!--/.span9-->
</div>
@stop