@extends('admin')

@section('navbar')
	@if($is_professor)
		@include('professor.navbar')
	@else <!--Institution-->
		@include('inst_admin.navbar')
	@endif
@stop

@section('content')
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Course > Detail <small> 
			@if($is_professor)
			/<a href="{{ url('/course/'.$course->id.'/edit') }}"> Edit </a></small>
			@endif
		</h1>
	</div>
</div>
@if(session('status'))
	<div class="alert alert-success fade in">
		 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Success!</strong> {{session('status')}}
	</div>
@endif

@if(session('opened'))
	<div class="alert alert-success fade in">
		 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Success!</strong> {{session('opened')}}
	</div>
@endif
<div class="row">
	<div class="col-lg-3">
		<img src="{{URL::asset('images/course/'.$course->course_image)}}" width="250" height="250">
	</div>
	<div class="col-lg-9">
		<h3>{{$course->name}}
			@if($is_professor && $course->is_open)
				(Opened for Students)
			@else
				(Still closed for students)
			@endif
		</h3>		
		<br/>
		<br/>
		
		<p>{!!  nl2br($course->course_description) !!}</p>
		
		<br/>
		@if($is_professor && $course->is_open == false)
			<form class="form-horizontal col-lg-1" role="form" method="POST" action="{{ url('/course/open') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">						
				<input type="hidden" name="course_id" value="{{ $course->id }}">
				<div class="form-group">
						<button type="submit" class="btn btn-primary">
							Open this Course
						</button>
				</div>								
			</form>	
		@endif
	</div>
</div>

<br/>


@if(session('addlecture'))
	<div class="alert alert-success fade in">
		 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Success!</strong> {{session('addlecture')}}
	</div>
@endif
<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Lecture List (<a href="{{url('/professor/add-lecture/'.$course->id)}}">Add Lecture</a>)</h3>
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
										<td>{{$lecture->lecture_name}}</td>
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

<!-- /.row -->
@stop