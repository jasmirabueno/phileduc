@extends('admin')

@section('navbar')
	@if($is_mainadmin)
		@include('main_admin.navbar')
	@elseif ($is_professor)
		@include ('professor.navbar')
	@else
		@include('inst_admin.navbar')
	@endif	
@stop

@section('content')
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Courses 
			@if($is_mainadmin)
				<small>list of PhilEd's Courses</small>
			@elseif ($is_professor)
				<small>list of Assigned Courses</small>
			@else
				<small>list of Institutions's Courses</small>
			@endif
		</h1>
	</div>
</div>
<!-- /.row -->
@if(session('status'))
	<div class="alert alert-success fade in">
		 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Success!</strong> {{session('status')}}
	</div>
@endif

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"> </h3>
				</div>			
				
				<div class="panel-body">
					@foreach($courses as $course)
					<div class="row">
						<div class="col-lg-1"></div>
						<div class="thumbnail col-lg-10">
							<div class="col-lg-2">
								<img src="{{URL::asset('images/course/'.$course->course_image)}}" width="100" height="100">
							</div>
							<div class="col-lg-10">
								@if(!$is_mainadmin && !$is_professor)
									<h4>{{$course->course_name}}</h4>	
								@else
									<h4><a href="{{url('course/'.$course->id)}}">{{$course->course_name}}</a></h4>	
								@endif
							</div>								
						</div>
						<div class="col-lg-1"></div>
					</div>
					@endforeach
				</div>
				
			</div>
		</div>
	</div>
@stop