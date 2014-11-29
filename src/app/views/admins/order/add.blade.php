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
                        <button type="submit" class="btn btn-info btn-large">เพิ่มสินค้า</button>
                    </div>
                    
                    {{Form::close()}}
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