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
			{{$courses->course_name}} <small>{{$courses->inst_name}}</small>
		</h1>
	</div>
	<div class="col-lg-1"></div>
</div>

<div class="row">
	<div class="col-lg-1"></div>
	<div class="col-lg-3">
		<div class="thumbnail">
			<img src="{{URL::asset('images/course/'.$courses->course_image)}}"  width="275" height="250">
		</div>
		<div class="caption">
			@if(!$is_enrolled)
			<form class="form-horizontal" role="form" method="POST" action="{{ url('student/enroll') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">						
				<input type="hidden" name="course_id" value="{{$courses->id}}">
				<div class="form-group strecth">
						<button type="submit" class="btn btn-primary">
							Enroll to this Course
						</button>
				</div>								
			</form>
			@endif
		</div>	
	</div>
	<div class="col-lg-7">
		<div class="row">
			<h3>Professor</h3>
			<img class="col-lg-2" src="{{URL::asset('images/professor/'.$courses->prof_image)}}">
			<div class="col-lg-10">
				<h4>{{$courses->prof_firstname." ".$courses->prof_lastname}}</h4>
			</div>	
		</div>
				
		<h3>About this Course</h3>
		<p>{{$courses->course_description}}</p>
	</div>
	<div class="col-lg-1"></div>
</div>
<br/><br/><br/>
@if($is_enrolled)
	<div class="row">
		<div class="col-lg-1"></div>
		<div class="col-lg-10">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Lecture List</h3>
				</div>			
				
				<div class="panel-body">
					<div class="row">
						<div class="container col-lg-12">
							<table class="table">
								<thead>
								<tr>
									<th>Lecture Name</th>
								</tr>
								</thead>
								<tbody>
								@foreach ($lectures as $lecture)
									<tr>
										<td><a href="{{url('lecture/'.$lecture->id)}}">{{$lecture->lecture_name}}</a></td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>           
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<div class="col-lg-1"></div>
@endif

@stop