@extends('web.layout.index')

@section('title')
    {{$tintuc->TieuDe}}
@endsection

@section('content')
<!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$tintuc->TieuDe}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">admin</a>
                </p>

                <!-- Preview Image -->
                <img class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="{{$tintuc->TieuDeKhongDau}}">

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on {{$tintuc->created_at}}</p>
                <hr>

                <!-- Post Content -->
                <p class="lead">{!! $tintuc->NoiDung !!}</p>

                <hr>

                <!-- Blog Comments -->
            
                <!-- Comments Form -->
                @if(isset($userLogin))
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                {{$error}}<br>
                            @endforeach
                        </div>
                    @endif

                    @if(session('message'))
                        <div class="alert alert-success">
                            {{session('message')}}
                        </div>
                    @endif

                    <div class="well">
                        <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                        <form role="form" action="comment/{{$tintuc->id}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="NoiDung"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </form>
                    </div>
                    <hr>
                @endif
                <!-- Posted Comments -->

                <!-- Comment -->
                @foreach($tintuc->comment as $cm)
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{$cm->user->name}}
                                <small>{{$cm->created_at}}</small>
                            </h4>
                            {{$cm->NoiDung}}
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">
                        @foreach($tinLienQuan as $tinLQ)
                            <!-- item -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <a href="news/{{$tinLQ->id}}/{{$tinLQ->TieuDeKhongDau}}.html">
                                        <img class="img-responsive" src="upload/tintuc/{{$tinLQ->Hinh}}" alt="{{$tinLQ->TieuDeKhongDau}}">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <a href="news/{{$tinLQ->id}}/{{$tinLQ->TieuDeKhongDau}}.html"><b>{{$tinLQ->TieuDe}}</b></a>
                                </div>
                                <p style="padding-left: 5px; padding-right: 5px;">{{$tinLQ->TomTat}}</p>
                                <div class="break"></div>
                            </div>
                            <!-- end item -->
                        @endforeach
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">
                        @foreach($tinNoiBat as $tinNB)
                            <!-- item -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <a href="news/{{$tinNB->id}}/{{$tinNB->TieuDeKhongDau}}.html">
                                        <img class="img-responsive" src="upload/tintuc/{{$tinNB->Hinh}}" alt="{{$tinNB->TieuDeKhongDau}}">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <a href="news/{{$tinNB->id}}/{{$tinNB->TieuDeKhongDau}}.html"><b>{{$tinNB->TieuDe}}</b></a>
                                </div>
                                <p style="padding-left: 5px; padding-right: 5px;">{{$tinNB->TomTat}}</p>
                                <div class="break"></div>
                            </div>
                            <!-- end item -->
                        @endforeach
                    </div>
                </div>
                
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->

@endsection