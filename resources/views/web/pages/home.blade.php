@extends('web.layout.index')

@section('title')
	{{"Trang chủ"}}
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
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Tin Tức</h2>
	            	</div>

	            	<div class="panel-body">
	            		<!-- items -->
	            		@foreach($theloai as $tl)
	            			@if(count($tl->loaitin) > 0)
							    <div class="row-item row">
				                	<h3>
				                		<a href="category.html">{{$tl->Ten}}</a> |
				                		@foreach($tl->loaitin as $lt)
				                			<small><a href="category.html"><i>{{$lt->Ten}}</i></a>/</small>
				                		@endforeach
				                	</h3>
				                	<?php
				                		$data = $tl->tintuc->where('NoiBat', 1)->sortByDesc('created_at')->take(5);

				                		// lấy 1 tin ra, trong $data chỉ còn 4 tin
				                		// shift() trả về kiểu mảng
				                		$firstNews = $data->shift(); 
				                	?>
				                	<div class="col-md-8 border-right">
				                		<div class="col-md-5">
					                        <a href="detail.html">
					                            <img class="img-responsive" src="upload/tintuc/{{$firstNews['Hinh']}}" width="200px" height="150px">
					                        </a>
					                    </div>

					                    <div class="col-md-7">
					                        <h3>{{$firstNews->TieuDe}}</h3>
					                        <p>{{$firstNews->TomTat}}</p>
					                        <a class="btn btn-primary" href="detail.html">Đọc tin <span class="glyphicon glyphicon-chevron-right"></span></a>
										</div>
				                	</div>

									<div class="col-md-4">
										@foreach($data as $otherNews)
											<a href="detail.html">
												<h4>
													<span class="glyphicon glyphicon-list-alt"></span> {{$otherNews->TieuDe}}
												</h4>
											</a>
										@endforeach
									</div>

									<div class="break"></div>
				                </div>
				            @endif
		                @endforeach
		                <!-- end items -->
					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->

@endsection