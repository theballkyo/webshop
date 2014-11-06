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
                    <h3>New order</h3>
                    *Note ลบข้อมูลลูกค้ายังทำไม่เสร็จ <br/>
                    <a href=" {{ url('admin/stock/show/1')}} " class="btn btn-info">แก้ไข Stock</a>
                        
                    {{Form::open()}}
                    <table class="table table-striped">
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
                                    @foreach($pd_s as $s)
                                        <td>
                                            {{ Form::text("amount[" . $stock[$c->id][$s->id]['code'] ."]",
                                            Input::old('amount['. $stock[$c->id][$s->id]['code'] .']'),
                                            ['class' => 'span1']) }}
                                            <strong> / 
                                            @if($stock[$c->id][$s->id] > 0)
                                            <span class="success">{{$stock[$c->id][$s->id]['stock']}}</span>
                                            @else
                                            <span class="warning">{{$stock[$c->id][$s->id]['stock']}}</span>
                                            @endif
                                            </strong>
                                        </td>
                                    @endforeach
                                </tr>   
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="span5">
                        <h2>รายชื่อลูกค้าเก่า</h2>
                        <div class="control-group">
                                <div class="controls">
                                    <select name="old_cus" tabindex="1" data-placeholder="ลูกค้าเก่า" class="span5">
                                        <option value="">หากเป็นลูกค้ารายใหม่ให้เลือกอันนี้แล้วไปกรอกข้อมูลด้านล่าง</option>
                                        @foreach($cus as $c)
                                        <option value="{{$c->id}}"
                                        {{Input::old('old_cus') == $c->id ? 'selected="selected"':''}}>
                                            {{$c->name}}
                                            Email::{{$c->email}}
                                            Tel::{{$c->tel}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        </div>
                    <div class="span6">
                    <p><h2>เพิ่มข้อมูลลูกค้าใหม่</h2></p>
                        <div class="control-group">
                            {{Form::label('name', 'Name *')}}
                            <div class="controls">
                                {{Form::text('name', Input::old('name'), ['class' => 'span6'])}}
                                @if($errors->has('name'))
                                <span class="help-inline alert">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="control-group">
                            {{Form::label('address', 'Address')}}
                            <div class="controls">
                                {{Form::textarea('address', Input::old('address'), ['class' => 'span6', 'rows' => 3])}}
                            </div>
                        </div>
                        <div class="control-group">
                            {{Form::label('email', 'E-mail')}}
                            <div class="controls">
                                {{Form::text('email', Input::old('email'), ['class' => 'span6'])}}    
                            </div>
                        </div>
                        <div class="control-group">
                            {{Form::label('tel', 'Tel.')}}
                            <div class="controls">
                                {{Form::text('tel', Input::old('tel'), ['class' => 'span6'])}}    
                            </div>
                        </div>
                        <div class="control-group">
                            {{Form::label('note', 'Note')}}
                            <div class="controls">
                                {{Form::textarea('note', Input::old('note'), ['class' => 'span6', 'rows' => '3'])}}
                            </div>
                        </div>
                    </div><!-- End span6 -->
                </div><!-- End Row -->
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-info btn-large">New Order</button>
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