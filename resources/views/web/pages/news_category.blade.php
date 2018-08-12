@extends('web.layout.index')

@section('title')
    {{$loaitin->Ten}}
@endsection

@section('content')
<!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- menu -->
            @include('web.layout.menu')
            <!-- end menu -->

            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>{{$loaitin->Ten}}</b></h4>
                    </div>

                    @foreach($tintuc as $tt)
                        <div class="row-item row">
                            <div class="col-md-3">
                                <a href="news/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">
                                    <img width="200px" height="200px" class="img-responsive" src="upload/tintuc/{{$tt->Hinh}}" alt="{{$tt->TieuDeKhongDau}}">
                                </a>
                            </div>
                            <div class="col-md-9">
                                <h3>{{$tt->TieuDe}}</h3>
                                <p>{{$tt->TomTat}}</p>
                                <a class="btn btn-primary" href="news/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">Đọc tin <span class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>
                            <div class="break"></div>
                        </div>
                    @endforeach

                    <!-- Pagination -->
                    <div class="row text-center">
                        <div class="col-lg-12">
                            {{$tintuc->links()}}
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
            </div> 

        </div>

    </div>
    <!-- end Page Content -->

@endsection