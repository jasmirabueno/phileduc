@extends('admin')

@section('navbar')
	@include('professor.navbar')
@stop

@section('content')
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Professor Profile <small> /<a href="{{ url('/professor/edit') }}"> Edit </a></small>
			
		</h1>
	</div>
</div>
@if(session('status'))
	<div class="alert alert-success fade in">
		 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Success!</strong> {{session('status')}}
	</div>
@endif
<div class="row">
	<div class="col-lg-3">
		<img src="{{URL::asset('images/professor/'.$professor->prof_image)}}" width="250" height="250">
	</div>
	<div class="col-lg-9">
		<h3>{{$professor->prof_firstname." ".$professor->prof_lastname}}</h3>		
		<br/>
		<br/>
		
		<p>{!!  nl2br($professor->prof_description) !!}</p>
	</div>
</div>

<!-- /.row -->
@stop