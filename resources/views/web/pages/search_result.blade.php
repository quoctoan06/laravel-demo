@extends('web.layout.index')

@section('title')
    {{"Kết quả tìm kiếm"}}
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
                        <h4><b>{{"Kết quả tìm kiếm với từ khoá: " . $keyword}}</b></h4>
                    </div>
                    
                    @if(count($tintuc) > 0)
                        @foreach($tintuc as $tt)
                            <div class="row-item row">
                                <div class="col-md-3">
                                    <a href="news/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">
                                        <img width="200px" height="200px" class="img-responsive" src="upload/tintuc/{{$tt->Hinh}}" alt="{{$tt->TieuDeKhongDau}}">
                                    </a>
                                </div>
                                <div class="col-md-9">
                                    <h3>{!! highlight($tt->TieuDe, $keyword) !!}</h3>
                                    <p>{!! highlight($tt->TomTat, $keyword) !!}</p>
                                    <a class="btn btn-primary" href="news/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">Đọc tin <span class="glyphicon glyphicon-chevron-right"></span></a>
                                </div>
                                <div class="break"></div>
                            </div>
                        @endforeach
                    @elseif(count($tintuc) == 0)
                        <h3 style="padding-left: 5px;">Không tìm thấy kết quả nào</h3>
                    @endif

                    <!-- Pagination -->
                    <div class="row text-center">
                        <div class="col-lg-12">
                            {{$tintuc->appends(Request::all())->links()}}
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
            </div> 

        </div>

    </div>
    <!-- end Page Content -->

@endsection