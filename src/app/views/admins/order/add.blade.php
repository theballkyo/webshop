@extends('layouts.admin')
@section('content')
<div class="row">
     <div class="span12">
        <div class="content">
            <div class="module">
                <div class="module-head">
                <h2>New Order..</h2>
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
                    <h3>เพิ่มสินค้าลงออเดอร์</h3>
                    {{Form::open()}}
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Size/Color</th>
                                <?php $i = 1;?>
                                @foreach($pd_s as $s)
                                <th class="{{$i%2 == 1 ? 'black' : 'white'}}">{{$s->text}}</th>
                                <?php $i++; ?>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>   
                            @foreach($pd_c as $c)
                                <tr>
                                    <td>{{$c->text}}</td>
                                    <?php $i = 1;?>
                                    @foreach($pd_s as $s)
                                        <td class="{{$i%2 == 1 ? 'black' : 'white'}}">
                                            {{ Form::text("amount[" . $stock[$c->id][$s->id]['code'] ."]",
                                            Input::old('amount['. $stock[$c->id][$s->id]['code'] .']'),
                                            ['class' => 'span1']) }}
                                            <strong> / 
                                            @if($stock[$c->id][$s->id] > 0)
                                            <span class="success">{{$stock[$c->id][$s->id]['stock']}}</span>
                                            @else
                                            <span class="warning">{{$stock[$c->id][$s->id]['stock']}}</span>
                                            @endif
                                            </strong><br/>
                                            SKU :: <strong>{{$s->text}}{{$c->code}}</strong>
                                        </td>
                                        <?php $i++; ?>
                                    @endforeach
                                </tr>   
                            @endforeach
                        </tbody>
                    </table>
                    <hr><button type="submit" class="btn btn-info btn-large">เพิ่มสินค้า</button>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
    <!--/.span11-->
</div>
@stop