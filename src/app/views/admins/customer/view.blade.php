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
                    <h2>Customer product reserve</h2>
                    <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th style="width:1" class="text-center">Product name</th>
                            <th style="width:20%" class="text-center">Color</th>
                            <th class="text-center">Size</th>
                            <th class="text-center">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($cus_reserve as $reserve)
                        <tr>
                            <td>{{$reserve['product']['name']}}</td>
                            @foreach($reserve['product']['detail'] as $detail)
                            <td>{{$detail['data']['text']}}</td>
                            @endforeach
                            <td>{{$reserve['amount']}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                    <h2>Customer profile</h2>
                    <form class="form-horizontal row-fluid" method="post">
                        <div class="control-group">
                            <label class="control-label" for="basicinput">Name</label>
                            <div class="controls">
                                <input value="{{$cus_user->name}}" type="text" id="basicinput" placeholder="" class="span8" disabled>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="basicinput">Address</label>
                            <div class="controls">
                                <textarea class="span8" rows="3" disabled>{{$cus_user->address}}</textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="basicinput">Email</label>
                            <div class="controls">
                                <input value="{{$cus_user->email}}" type="text" id="basicinput" placeholder="" class="span8" disabled>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="basicinput">Tel.</label>
                            <div class="controls">
                                <input value="{{$cus_user->tel}}" type="text" id="basicinput" placeholder="" class="span8" disabled>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="basicinput">Note</label>
                            <div class="controls">
                                <textarea class="span8" rows="3">{{$cus_user->note}}</textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn btn-info btn-large">Edit profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/.span9-->
</div>
@stop
