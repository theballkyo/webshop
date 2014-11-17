@extends('layouts.admin')
@section('content')
<div class="row">
     <div class="span12">
        <div class="content">
            <div class="module">
                <div class="module-head">
                </div>
                <div class="module-body">
                    <div class="alert warning">
                        <strong>Warning :: </strong>
                        ขณะนี้กำลังอยู่ช่วงทดสอบระบบอยู่อาจมีปัญหาบางอย่าง !
                    </div>
                    <h3>Edit Stock</h3>
                    <strong>สินค้าตัวไหนไม่ต้องการแก้ไขให้ปล่อยว่างไว้</strong>
                    {{Form::open()}}
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Size/Color</th>
                                @foreach($pd_s as $s)
                                    <th>{{$s->text}}</th>
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
                                            ['class' => 'span1']) }}<br/>
                                            <strong>
                                            @if($stock[$c->id][$s->id] > 0)
                                            <span class="success">{{$stock[$c->id][$s->id]['stock']}}</span>
                                            @else
                                            <span class="warning">{{$stock[$c->id][$s->id]['stock']}}</span>
                                            @endif
                                            ชิ้น
                                            </strong><br/>
                                            {{ Form::text("price[" . $stock[$c->id][$s->id]['code'] ."]",
                                            Input::old('price['. $stock[$c->id][$s->id]['code'] .']'),
                                            ['class' => 'span1']) }}<br/>
                                            <strong>
                                            @if($stock[$c->id][$s->id] > 0)
                                            <span class="success">{{$stock[$c->id][$s->id]['price']}}</span>
                                            @else
                                            <span class="warning">{{$stock[$c->id][$s->id]['price']}}</span>
                                            @endif
                                            บาท
                                            </strong><br/>
                                            SKU :: <strong>{{$s->text}}{{$c->code}}</strong>
                                        </td>
                                        <?php $i++; ?>
                                    @endforeach
                                </tr>   
                            @endforeach
                        </tbody>
                    </table>
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-info btn-large">แก้ไข Stock</button>
                    </div>
                </div>
                        {{Form::token()}}
                    </form>   
                </div>
            </div>
        </div>
    </div>
    <!--/.span12-->
</div>
@stop