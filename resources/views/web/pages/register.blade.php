@extends('web.layout.index')

@section('title')
    {{"Đăng ký"}}
@endsection

@section('content')
<!-- Page Content -->
<div class="container">

	<!-- slider -->
	<div class="row carousel-holder">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
			  	<div class="panel-heading">Đăng ký tài khoản</div>
			  	<div class="panel-body">

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

			    	<form action="register" method="post">
			    		<input type="hidden" name="_token" value="{{csrf_token()}}">
			    		<div>
			    			<label>Tên người dùng</label>
						  	<input type="text" class="form-control" placeholder="Nhập tên người dùng" name="name" aria-describedby="basic-addon1">
						</div>
						<br>
						<div>
			    			<label>Email</label>
						  	<input type="email" class="form-control" placeholder="Nhập email" name="email" aria-describedby="basic-addon1">
						</div>
						<br>	
						<div>
			    			<label>Nhập mật khẩu</label>
						  	<input type="password" class="form-control" placeholder="Nhập mật khẩu" name="password" aria-describedby="basic-addon1">
						</div>
						<br>
						<div>
			    			<label>Nhập lại mật khẩu</label>
						  	<input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="passwordAgain" aria-describedby="basic-addon1">
						</div>
						<br>
						<button type="submit" class="btn btn-success">Đăng ký</button>
			    	</form>
			  	</div>
			</div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
    <!-- end slide -->
</div>
<!-- end Page Content -->

@endsection