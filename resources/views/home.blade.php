<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>PhilEd- Online Teaching</title>

	<link rel="shortcut icon" href="assets/images/gt_favicon.png">
	
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<link href="{!! asset('css/bootstrap.min.css') !!}" rel="stylesheet">
	<link href="{!! asset('css/font-awesome.min.css') !!}" rel="stylesheet">	
	
	
	<!-- Custom styles for our template -->
	<link href="{!! asset('css/bootstrap-theme.css') !!}" rel="stylesheet">	
	
	<link href="{!! asset('css/main.css') !!}" rel="stylesheet">	

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
		
	@include('navbarmain')

	<section id="header">
		<div class="col-lg-6">
			@if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
		</div>
		<div class="col-lg-5" id="register" >
			<h2 id="title" >Register and get access to PhilEduc's Courses</h2>
			<form class="form-horizontal "   role="form" method="POST" action="{{ url('register/') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="role_id" value="{{ 4 }}">
			<ul class="input-list style-4 clearfix">
				<li>
					<div class="form-group">
						<div class="col-md-10">
							<input  placeholder="Enter Email Address" type="email"  name="email" value="{{ old('email') }}">
						</div>
					</div>					
				</li>
				<li>
					<div class="form-group">
						<div class="col-md-10">
							<input type="password" placeholder="Enter Password" name="password">
						</div>
					</div>					
				</li>
				<li>
					<div class="form-group">
						<div class="col-md-10">
							<input type="password" placeholder="Reenter Password" name="password_confirmation">
						</div>
					</div>					
				</li>				
				<li>
					<div class="form-group form-style-5">
						<div class="col-md-10">
							<input type="submit" value="REGISTER">
						</div>
					</div>					
				</li>
			</ul>
			</form>
		</div>
		<div class="col-lg-1"></div>
	</section>



	
	<section id="courses">
		<div class="container-fluid">
			<div class="row">
				
				
			</div>
		</div>
	</section>

<!-- /row of widgets 
	<footer id="footer" class="top-space">
		<div class="footer1">
			<div class="container">
				<div class="row">
					
					<div class="col-md-7 widget">
						<h3 class="widget-title">PhilEduc</h3>
						<div class="widget-body">
							<p>PhilEduc provides universal access to the world’s best 
								education, partnering with top universities and organizations
								 to offer courses online.</p>
						</div>
					</div>

				</div> 
			</div>
		</div>
			</div>
		</div>
	</footer>	
	-->



	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="{!! asset('js/js/headroom.min.js') !!}"></script>
	<script src="{!! asset('js/jQuery.headroom.min.js') !!}"></script>
	<script src="{!! asset('js/template.js') !!}"></script>
</body>
</html>