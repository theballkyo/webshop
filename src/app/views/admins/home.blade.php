@extends('layouts.admin')
@section('content')
<div class="row">
     
     <div class="span12">
        <div class="content">
            <div class="module">
                <div class="module-head">
                <h3>
                Welcome ,{{ Auth::user()->username }}</h3>
                </div>
                <div class="module-body">
                    <div class="alert warning">
                        <strong>Warning :: </strong>
                        ขณะนี้กำลังอยู่ช่วงทดสอบระบบอยู่อาจมีปัญหาบางอย่าง !
                    </div>
                    <h3>ยินดีต้อนรับสู่ Sommai Stock Manager</h3>
                    *Note ลบข้อมูลลูกค้ายังทำไม่เสร็จ
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin-nav')
    <!--/.span9-->
</div>
@stop