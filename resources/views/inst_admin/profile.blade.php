@extends('admin')

@section('navbar')
	@include('inst_admin.navbar')
@stop

@section('content')
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Institution Profile <small> /<a href="{{ url('/institution/edit') }}"> Edit </a></small>
			
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
		<img src="{{URL::asset('images/institution/'.$institution->logo)}}" width="250" height="250">
	</div>
	<div class="col-lg-9">
		<h3>{{$institution->inst_name}}</h3>
		<h4>{{$institution->email}}</h4>
		<h4>{{$institution->contactno}}</h4>
		
		<br/>
		<br/>
		
		<p>{!!  nl2br($institution->inst_description) !!}</p>
	</div>
</div>

<!-- /.row -->
@stop