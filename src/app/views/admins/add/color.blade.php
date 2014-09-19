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
                    <form action="" method="post">
                        <lable for="size">Size :: </lable> <input name="size" type="text"><br>
                        <input type="submit" class="btn btn-large btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/.span9-->
</div>
@stop