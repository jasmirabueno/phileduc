@extends('app')

@section('navbar')
	@if($is_student)
		@include('student.navbar')
	@else
		@include('navbarmain')
	@endif
@stop

@section('content')
<div class="row">
	<div class="col-lg-1"></div>
	<div class="col-lg-10">
		<h1 class="page-header">
			<br/><br/>
			Browse PhilEduc's Courses
		</h1>
	</div>
	<div class="col-lg-1"></div>
</div>
<div class="row">
	<div class="col-lg-1"></div>
	<div class="col-lg-3">
		<table class="table">
				<thead>
				<tr>
					<th>Categories</th>
				</tr>
				</thead>
				<tbody>
				@foreach ($categories as $category)
					<tr>
						<td>{{$category->categ_name}}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
	</div>
	<div class="col-lg-7">
	<div class="panel panel-default">			
		<div class="panel-heading">
			<h3 class="panel-title">Courses</h3>
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
									<p>{{$course->inst_name}}</p>
								</div>								
							</div>
						</div>
					@endforeach
				@endif
		</div>
	</div>
	<div class="col-lg-1"></div>
</div>
<!-- /.row -->
@stop