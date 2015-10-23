<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top headroom" >
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="{{url('course')}}"><img src="{{URL::asset('/images/philed/philed-logo.jpg')}}" height="45" ></img></a>
			</div>

			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<li><a href="{{url('course')}}">Browse Courses</a></li>
					<li><a href="{{url('student/')}}">Dashboard</a></li>
					<li><a href="{{url('student/settings')}}">Settings</a></li>
					<li><a href="{{url('logout')}}">Log Out</a></li>
					
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div> 
	<!-- /.navbar -->