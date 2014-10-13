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
                    @if(Session::get('success'))
                    <div class="alert alert-success">
                        <strong>Message :: </strong>
                            อัพเดท
                    </div>
                    @endif
                	<table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th style="width:20%" class="text-center">Product name</th>
                            <th style="width:5%" class="text-center">Color</th>
                            <th style="width:5%" class="text-center">Size</th>
                            <th style="width:5%" class="text-center">Amount</th>
                            <th style="width:5%">Price</th>
                            <th>Discount Price</th>
                            <th>Discount Type</th>
                            <th>Discount % or Bath</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($cus_reserve as $reserve)
                        <tr>
                            <form method="post">
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
                            <div class="control-group">
                            <label class="control-label">ประเภทการลดราคา</label>
                                <div class="controls type">
                                    <select name="discount_type" tabindex="1" data-placeholder="ลูกค้าเก่า" class="span2">
                                        <option value="0">ไม่ต้องการลดราคา</option>
                                        <option value="1">ลดราคาไป XXX บาท</option>
                                        <option value="2">ลดราคาไป XX%</option>
                                        <option value="3">ลดราคาเหลือ XXX บาท</option>
                                    </select>
                                </div>
                            </div>
                            </td>
                            <td>
                                กรอกราคาที่ต้องการลด<br>
                                <input class="span1" type="text" name="discount" value="{{$reserve['discount']}}">
                                <br>*ไม่ต้องใส่ % หรือ บาท ตามหลัง
                                <br><button class="btn btn-success">ตกลง</button>
                            </td>
                            {{Form::token()}}
                            </form>
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
@section('script')
<script type="text/javascript">
    $(".type select").val("{{$reserve['discount_type']}}");
</script>
@stop