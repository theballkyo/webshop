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
                    <h3>New order</h3>
                    *Note ลบข้อมูลลูกค้ายังทำไม่เสร็จ <br/>
                    <a href=" {{ url('admin/stock/show/1')}} " class="btn btn-info">แก้ไข Stock</a>
                    <a href=" {{ url('admin/product/add/color/1')}} " class="btn btn-warning">เพิ่มสีสินค้า</a>
                    <a href=" {{ url('admin/product/add/size/1')}} " class="btn btn-warning">เพิ่ม Size สินค้า</a><br/><br/>
                    {{Form::open()}}
                    <div class="row">
                        <!--
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
                    -->
                    <div class="span11">
                    <p><h2>เพิ่มข้อมูลลูกค้าใหม่</h2></p>

                        <div class="control-group">
                            <div class="controls">
                                {{Form::label('SKU', 'SKU')}}
                                <select id="sku" name="sku" tabindex="1" data-placeholder="SKU" class="span3">
                                    @foreach($pd_s as $s)
                                        @foreach($pd_c as $c)
                                            <option value="{{$stock[$c->id][$s->id]['code']}}">{{$s->text}}{{$c->code}} ({{$stock[$c->id][$s->id]['stock']}})</option>
                                        @endforeach
                                    @endforeach
                                </select>
                                
                                <input type="number" name="amount2" class="span2 amount2" min="1" value="1">
                                <a onclick="return;" id="add" class="btn btn-info">Add</a>
                            </div>
                        </div>
                        <table id="table-sku" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th>Amount</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                        <div class="control-group">
                            <div class="controls">
                                {{Form::label('status', 'สถานะ')}}
                                <select name="status" tabindex="1" data-placeholder="สถานะ" class="span11">
                                    <option value="0">รอจ่ายเงิน</option>
                                    <option value="1">จ่ายเงินแล้ว</option>
                                    <option value="5">รอของมา</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                {{Form::label('shipping', 'shipping')}}
                                <select name="shipping" tabindex="1" data-placeholder="shipping" class="span11">
                                    <option value="1">EMS</option>
                                    <option value="2">Register</option>
                                    <option value="3">รับเอง</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            {{Form::label('name', 'Name *')}}
                            <div class="controls">
                                {{Form::text('name', Input::old('name'), ['class' => 'span11'])}}
                                @if($errors->has('name'))
                                <span class="help-inline alert">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                {{Form::label('source', 'ที่มา')}}
                                <select name="source" tabindex="1" data-placeholder="ที่มา" class="span11">
                                    <option value="1">Line</option>
                                    <option value="2">สมหมาย</option>
                                    <option value="3">ขายกางเกง</option>
                                    <option value="4">Web</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            {{Form::label('address', 'Address')}}
                            <div class="controls">
                                {{Form::textarea('address', Input::old('address'), ['class' => 'span11', 'rows' => 3])}}
                            </div>
                        </div>
                        <div class="control-group">
                            {{Form::label('email', 'E-mail')}}
                            <div class="controls">
                                {{Form::text('email', Input::old('email'), ['class' => 'span11'])}}    
                            </div>
                        </div>
                        <div class="control-group">
                            {{Form::label('tel', 'Tel.')}}
                            <div class="controls">
                                {{Form::text('tel', Input::old('tel'), ['class' => 'span11'])}}    
                            </div>
                        </div>
                        <div class="control-group">
                            {{Form::label('note', 'Note')}}
                            <div class="controls">
                                {{Form::textarea('note', Input::old('note'), ['class' => 'span11', 'rows' => '3'])}}
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
    <!--/.span11-->
</div>
@stop
@section('script')
<script>
$(document).ready(function() { $("#sku").select2(); });
            
            var table = $('#table-sku').DataTable({
                paging: false,
                searching: false,
                info: false,
                lengthChange: false
            });

            $('#add').on('click', function() {
                table.row.add( [
                    '<input type="hidden" id="ArrayCombination_id[]" name="ArrayCombination_id[]" value="' + $('#sku option:selected').val() + '"></input>' + $('#sku option:selected').text(),
                    '<input type="number" id="amount['+ $('#sku option:selected').val() +']" name="amount['+ $('#sku option:selected').val() +']" min="1" value="' + $('.amount2').val() + '"></input>',
                    '<a class="delete btn btn-danger">Delete</a>'
                ] ).draw();

                $('.delete').click(function() {
                    table.row($(this).parents('tr')).remove().draw();
                });
            } );
    
</script>
@stop