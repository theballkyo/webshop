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
                    <p>
                    <strong>Default</strong>
                    <?php var_dump(Session::get('error.msg')); ?>

                    <small>table class="table"</small>
                    </p>
                    @foreach($products as $product)
                        <h3>Name</h3>{{$product['name']}}
                        <h3>Detail</h3>
                        @foreach($product['detail'] as $detail)
                            <h4>{{$detail['name']}}</h4>
                            @foreach($detail['datas'] as $data)
                                {{$data['text']}}
                            @endforeach
                            <br>
                        @endforeach
                        <hr>
                    @endforeach
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                           @foreach($product['detail'][0]['datas'] as $color)
                           <tr>
                                <td>{{$product['name']}}</td>
                                <td>{{$color['text']}}</td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                    </table>
            </div>
        </div>
    </div>
    <!--/.span9-->
</div>
@stop