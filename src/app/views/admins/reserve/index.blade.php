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
                	<h2>Wait for payment</h2>
                    <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th style="width:20%" class="text-center">Product name</th>
                            <th style="width:5%" class="text-center">Color</th>
                            <th style="width:5%" class="text-center">Size</th>
                            <th style="width:5%" class="text-center">Amount</th>
                            <th style="width:5%">Price</th>
                            <th>Discount price</th>
                            <th>Discount Type</th>
                            <th class="text-center">Do</th>
                            <th style="width:15%"class="text-center">Payment</th>
                            <th>Reserve Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($r_wait as $reserve)
                        <tr>
                            <td>{{$reserve['cus_id']}}</td>
                            <td>{{$reserve['product']['name']}}</td>
                            @foreach($reserve['product']['detail'] as $detail)
                            <td>{{$detail['data']['text']}}</td>
                            @endforeach
                            <td>{{$reserve['amount']}}</td>
                            <td>{{$reserve['price']}}</td>
                            <td>
                            @if($reserve['discount_type'] == 0)
                                {{$reserve['price']}}
                            @elseif($reserve['discount_type'] == 1)
                                {{$reserve['price'] - $reserve['discount']}}
                            @elseif($reserve['discount_type'] == 2)
                                {{ ceil(($reserve['price'] ) * ((100 - $reserve['discount']) / 100)) }}
                            @elseif($reserve['discount_type'] == 3)
                                {{$reserve['discount']}}
                            @elseif($reserve['discount_type'] == 4)
                            @endif
                            </td>
                            <td>
                            @if($reserve['discount_type'] == 0)
                                0 บาท
                            @elseif($reserve['discount_type'] == 1)
                                ลดไป {{ $reserve['discount'] }} บาท
                            @elseif($reserve['discount_type'] == 2)
                                {{ $reserve['discount'] }} %
                            @elseif($reserve['discount_type'] == 3)
                                ลดเหลือ {{$reserve['discount']}} บาท
                            @elseif($reserve['discount_type'] == 4)
                            @endif
                            </td>
                            <td class="text-center">
                                @if($reserve['payment'] == 0)
                                <a class="btn btn-success" href="{{url('admin/stock/reserve/discount/'.$reserve['id'])}}">Discount</a>
                                <p><a class="btn" href="{{url('admin/stock/reserve/cancel/'.$reserve['id'])}}">Cancel</a></p>
                                @endif
                            </td>
                            <td class="text-center">
                            <form method="post" class="form-horizontal row-fluid">
                            <label class="checkbox inline">
                            <input type="hidden" name="payment" value="0" />
                            <input name="payment" type="checkbox" value="1" onChange="this.form.submit()"
                                {{ $reserve['payment'] == '1' ? 'checked' : ''}} />
                            ชำระเงินเรียบร้อย
                            </label>
                            <input type="hidden" name="reserve_id" value="{{$reserve['id']}}" />
                            {{Form::token()}}
                            </form>
                            </td>
                            <td>{{date('d/m/Y h:i:s A', strtotime($reserve['created_at']))}}</td>
                        </tr>
                    @endforeach
                	</tbody>
                	</table>
                    <hr>
                    <h3>Payment success</h3>
                    <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th style="width:20%" class="text-center">Product name</th>
                            <th style="width:5%" class="text-center">Color</th>
                            <th style="width:5%" class="text-center">Size</th>
                            <th style="width:5%" class="text-center">Amount</th>
                            <th style="width:5%">Price</th>
                            <th>Discount price</th>
                            <th>Discount Type</th>
                            <th>Reserve Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($r_succ as $reserve)
                        <tr>
                            <td>{{$reserve['cus_id']}}</td>
                            <td>{{$reserve['product']['name']}}</td>
                            @foreach($reserve['product']['detail'] as $detail)
                            <td>{{$detail['data']['text']}}</td>
                            @endforeach
                            <td>{{$reserve['amount']}}</td>
                            <td>{{$reserve['price']}}</td>
                            <td>
                            @if($reserve['discount_type'] == 0)
                                {{$reserve['price']}}
                            @elseif($reserve['discount_type'] == 1)
                                {{$reserve['price'] - $reserve['discount']}}
                            @elseif($reserve['discount_type'] == 2)
                                {{ ceil(($reserve['price'] ) * ((100 - $reserve['discount']) / 100)) }}
                            @elseif($reserve['discount_type'] == 3)
                                {{$reserve['discount']}}
                            @elseif($reserve['discount_type'] == 4)
                            @endif
                            </td>
                            <td>
                            @if($reserve['discount_type'] == 0)
                                0 บาท
                            @elseif($reserve['discount_type'] == 1)
                                ลดไป {{ $reserve['discount'] }} บาท
                            @elseif($reserve['discount_type'] == 2)
                                {{ $reserve['discount'] }} %
                            @elseif($reserve['discount_type'] == 3)
                                ลดเหลือ {{$reserve['discount']}} บาท
                            @elseif($reserve['discount_type'] == 4)
                            @endif
                            </td>
                            <td>{{date('d/m/Y h:i:s A', strtotime($reserve['created_at']))}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                    <hr>
                    <h3>Cancel</h3>
                    <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th style="width:20%" class="text-center">Product name</th>
                            <th style="width:5%" class="text-center">Color</th>
                            <th style="width:5%" class="text-center">Size</th>
                            <th style="width:5%" class="text-center">Amount</th>
                            <th style="width:5%">Price</th>
                            <th>Discount price</th>
                            <th>Discount Type</th>
                            <th style="width:15%"class="text-center">Payment</th>
                            <th>Reserve Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($r_cancel as $reserve)
                        <tr>
                            <td>{{$reserve['cus_id']}}</td>
                            <td>{{$reserve['product']['name']}}</td>
                            @foreach($reserve['product']['detail'] as $detail)
                            <td>{{$detail['data']['text']}}</td>
                            @endforeach
                            <td>{{$reserve['amount']}}</td>
                            <td>{{$reserve['price']}}</td>
                            <td>
                            @if($reserve['discount_type'] == 0)
                                {{$reserve['price']}}
                            @elseif($reserve['discount_type'] == 1)
                                {{$reserve['price'] - $reserve['discount']}}
                            @elseif($reserve['discount_type'] == 2)
                                {{ ceil(($reserve['price'] ) * ((100 - $reserve['discount']) / 100)) }}
                            @elseif($reserve['discount_type'] == 3)
                                {{$reserve['discount']}}
                            @elseif($reserve['discount_type'] == 4)
                            @endif
                            </td>
                            <td>
                            @if($reserve['discount_type'] == 0)
                                0 บาท
                            @elseif($reserve['discount_type'] == 1)
                                ลดไป {{ $reserve['discount'] }} บาท
                            @elseif($reserve['discount_type'] == 2)
                                {{ $reserve['discount'] }} %
                            @elseif($reserve['discount_type'] == 3)
                                ลดเหลือ {{$reserve['discount']}} บาท
                            @elseif($reserve['discount_type'] == 4)
                            @endif
                            </td>
                            <td class="text-center">
                            <form method="post" class="form-horizontal row-fluid">
                            <label class="checkbox inline">
                            <input type="hidden" name="payment" value="0" />
                            <input name="payment" type="checkbox" value="1" onChange="this.form.submit()"
                                {{ $reserve['payment'] == '1' ? 'checked' : ''}} />
                            ชำระเงินเรียบร้อย
                            </label>
                            <input type="hidden" name="reserve_id" value="{{$reserve['id']}}" />
                            {{Form::token()}}
                            </form>
                            </td>
                            <td>{{date('d/m/Y h:i:s A', strtotime($reserve['created_at']))}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                    *Note ยังไม่เสร็จจ๊ะ
                </div>
            </div>
        </div>
    </div>
    <!--/.span9-->
</div>
@stop
