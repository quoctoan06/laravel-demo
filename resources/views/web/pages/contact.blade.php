@extends('web.layout.index')

@section('title')
    {{"Liên hệ"}}
@endsection

@section('content')
<!-- Page Content -->
    <div class="container">

        <!-- slider -->
        @include('web.layout.slide')
        <!-- end slide -->

        <div class="space20"></div>


        <div class="row main-left">
            <!-- menu -->
            @include('web.layout.menu')
            <!-- end menu -->

            <div class="col-md-9">
                <div class="panel panel-default">            
                    <div class="panel-heading" style="background-color:#337AB7; color:white;" >
                        <h2 style="margin-top:0px; margin-bottom:0px;">Liên hệ</h2>
                    </div>

                    <div class="panel-body">
                        <!-- item -->
                        <h3><span class="glyphicon glyphicon-align-left"></span> Thông tin liên hệ</h3>
                        
                        <div class="break"></div>
                        <h4><span class= "glyphicon glyphicon-home "></span> Địa chỉ : </h4>
                        <p>Q. Hai Ba Trung, Ha Noi </p>

                        <h4><span class="glyphicon glyphicon-envelope"></span> Email : </h4>
                        <p>xxxxxxxx@gmail.com </p>

                        <h4><span class="glyphicon glyphicon-phone-alt"></span> Điện thoại : </h4>
                        <p>097509xxxx </p>



                        <br><br>
                        <h3><span class="glyphicon glyphicon-globe"></span> Bản đồ</h3>
                        <div class="break"></div><br>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14898.441644394117!2d105.84304390592278!3d21.008248385998307!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac1eb17075a1%3A0xb1f717592512c549!2zSGFpIELDoCBUcsawbmcsIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1534122572938" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection