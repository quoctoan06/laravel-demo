@extends('web.layout.index')

@section('title')
    {{"Thông tin tài khoản"}}
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
				  	<div class="panel-heading">Thông tin tài khoản</div>
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
                    
				    	<form action="user" method="post">
				    		<input type="hidden" name="_token" value="{{csrf_token()}}">
				    		<div>
				    			<label>Tên người dùng</label>
							  	<input type="text" class="form-control" placeholder="Username" name="name" aria-describedby="basic-addon1" value="{{$userLogin->name}}">
							</div>
							<br>
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1" value="{{$userLogin->email}}" readonly="true">
							</div>
							<br>	
							<div>
								<input type="checkbox" name="changePassword" id="changePassword">
				    			<label>Đổi mật khẩu</label>
							  	<input type="password" class="form-control password" name="password" placeholder="Nhập mật khẩu mới" disabled="true" aria-describedby="basic-addon1">
							</div>
							<br>
							<div>
				    			<label>Nhập lại mật khẩu</label>
							  	<input type="password" class="form-control password" name="passwordAgain" placeholder="Nhập lại mật khẩu" disabled="true" aria-describedby="basic-addon1">
							</div>
							<br>
							<button type="submit" class="btn btn-success">Cập nhật</button>
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

@section('script')
    <script>
        $(document).ready(function() {
            $('#changePassword').change(function() {
                if($(this).is(":checked")) {
                    $('.password').removeAttr('disabled');
                } else {
                    $('.password').attr('disabled', 'true');
                }
            });
        });
    </script>
@endsection