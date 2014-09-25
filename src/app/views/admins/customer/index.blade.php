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
                    <a class="btn btn-info" href="{{url('admin/customer/add')}}">เพิ่มข้อมูลลูกค้าใหม่</a>
                    <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th style="width:1" class="text-center">ID</th>
                            <th style="width:20%" class="text-center">Name</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Email</th>
                            <th style="width:10%" class="text-center">Tel.</th>
                            <th class="text-center">Note</th>
                            <th style="width:5%" class="text-center">From A/C</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($cus_users as $cus)
                    	<tr>
                    		<td>{{$cus->id}}</td>
                    		<td><a href="{{url('admin/customer/'.$cus->id.'')}}">{{{$cus->name}}}</a></td>
                    		<td>{{{$cus->address}}}</td>
                    		<td>{{{$cus->email}}}</td>
                    		<td>{{{$cus->tel}}}</td>
                    		<td>{{{$cus->note}}}</td>
                    		<td>{{ $cus->ac_id > 0 ? '<a href="'. url('admin/customer/'.$cus->ac_id.'').'">#'. $cus->ac_id .'</a>' : 'None'}}</td>
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
