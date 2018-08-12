@extends('web.layout.index')

@section('title')
	{{"Đăng nhập"}}
@endsection

@section('content')
<!-- Page Content -->
    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
    		<div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
				  	<div class="panel-heading">Đăng nhập</div>
				  	<div class="panel-body">

				  		@if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    {{$error}}<br>
                                @endforeach
                            </div>
                        @endif
                        
				    	<form action="login" method="post">
				    		<input type="hidden" name="_token" value="{{csrf_token()}}">
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" placeholder="Email" 
							  	name="email" 
							  	>
							</div>
							<br>	
							<div>
				    			<label>Mật khẩu</label>
							  	<input type="password" class="form-control" placeholder="Mật khẩu" name="password">
							</div>
							<br>
							<button type="submit" class="btn btn-success">Đăng nhập
							</button>
				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->

@endsection