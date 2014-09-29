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
                	<h2>Customer</h2>
                    <p><a class="btn btn-info" href="{{url('admin/customer/add')}}">เพิ่มข้อมูลลูกค้าใหม่</a></p>
                    <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th style="width:1" class="text-center">ID</th>
                            <th style="width:20%" class="text-center">Name</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Email</th>
                            <th style="width:10%" class="text-center">Tel.</th>
                            <th class="text-center">Note</th>
                            <th class="text-center">From A/C</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($cus_users as $cus)
                    	<tr>
                    		<td>{{$cus->id}}</td>
                    		<td><a href="{{url('admin/customer/'.$cus->id.'')}}">{{{$cus->name}}}</a></td>
                    		<td>{{nl2br($cus->address)}}</td>
                    		<td>{{{$cus->email}}}</td>
                    		<td>{{{$cus->tel}}}</td>
                    		<td>{{nl2br($cus->note)}}</td>
                    		<td>{{ $cus->ac_id > 0 ? '<a href="'. url('admin/customer/'.$cus->ac_id.'').'">#'. $cus->ac_id .'</a>' : 'None'}}</td>
                            <td>
                            <form method="get" action=""
                                    onsubmit="return confirm('คุณต้องการลบข้อมูลลูกค้าคนนี้หรือไม่ ?');">
                                <button class="btn btn-inverse">Delete</button>
                                {{Form::token()}}
                            </form>
                            </td>
                    	</tr>
                    @endforeach
                	</tbody>
                	</table>
                    *Note ลบข้อมูลลูกค้ายังทำไม่เสร็จ
                </div>
            </div>
        </div>
    </div>
    <!--/.span9-->
</div>
@stop
