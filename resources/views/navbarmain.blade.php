<!-- Fixed navbar -->
	<div class="navbar navbar-inverse headroom" >
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="/"><img src="{{URL::asset('/images/philed/philed-logo.jpg')}}" height="45" ></img></a>
			</div>
			<form class="navbar-form navbar-right" method="POST" action="{{ url('login/4') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<input type="text" class="form-control" name="email" placeholder="Email">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" name="password" placeholder="Password">
				</div>
				<button type="submit" class="btn btn-primary">Log In</button>
			</form>
		</div>
	</div> 
	<!-- /.navbar -->