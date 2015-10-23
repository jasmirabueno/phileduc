@extends('app')

@section('navbar')
		@include('student.navbar')
@stop

@section('content')
<div class="row">
	<div class="col-lg-1"></div>
	<div class="col-lg-10">
		<h1 class="page-header">
			<br/><br/>
			{{$lecture->lecture_name}} 
		</h1>
	</div>
	<div class="col-lg-1"></div>
</div>

<div class="row">
	<div class="col-lg-1"></div>
	<div class="col-lg-10">
		<video controls width="1050">
			<source src="{{url::asset('videos/lectures/'.$lecture->video)}}" type="video/mp4">
			<source src="movie.ogg" type="video/ogg">
			Your browser does not support the video tag.
		</video>
	</div>
	<div class="col-lg-1"></div>
</div>

<div class="row">
	<div class="col-lg-1"></div>
	<div class="col-lg-10">
		<h3> Course Description </h3>
		{{$lecture->lecture_description}}
	</div>
	<div class="col-lg-1"></div>
</div>

@stop