@extends('app')

@section('navbar')
	@include('student.navbar')
@stop

@section('content')
<div class="row">
	<div class="col-lg-1"></div>
	<div class="col-lg-10">
		<h1 class="page-header">
			<br/><br/><br/>
			{{$student->stud_firstname}}'s Dashboard 
		</h1>
	</div>
	<div class="col-lg-1"></div>
</div>
<!-- /.row -->

<div class="row">
	<div class="col-lg-1"></div>
	<div class="col-lg-3">
		<div class="thumbnail">
			<img src="{{URL::asset('images/student/'.$student->stud_image)}}"  width="300" height="300">
			<div class="caption">
				<h3>{{$student->stud_firstname." ".$student->stud_lastname}}</h3>
				<p>{{$student->stud_description}}</p>
				
			</div>
		</div>
	</div>
	<div class="col-lg-7">
		<div class="panel panel-default">			
			<div class="panel-heading">
				<h3 class="panel-title">Courses Enrolled</h3>
			</div>
			<div class="panel-body">
				@if($courses)
				@foreach($courses as $course)
					<div class="row">
						<div class="thumbnail col-lg-12">
							<div class="col-lg-2">
								<img src="{{URL::asset('images/course/'.$course->course_image)}}" width="100" height="100">
							</div>
							<div class="col-lg-10">
									<h4><a href="{{url('course/'.$course->id)}}">{{$course->course_name}}</a></h4>	
							</div>								
						</div>
					</div>
				@endforeach
				@endif
			</div>
	</div>
	<div class="col-lg-1"></div>
</div>
@stop