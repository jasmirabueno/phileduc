@extends('admin')

@section('navbar')
	@include('professor.navbar')
@stop

@section('content')
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Edit Profile 
			
		</h1>
	</div>
</div>

<div class="row">
	<form class="form-horizontal" role="form" method="POST" action="{{ url('professor/edit_profile') }}" enctype="multipart/form-data">
	<div class="col-lg-3">
		<img src="{{URL::asset('images/professor/'.$professor->prof_image)}}" width="250" height="250">
		<br/>
		<div class="col-md-2"></div>
		<div class="form-group" class="col-md-9">
			<label  for="image">Change Logo</label>
			<input  type="file" id="image" name="image" value="{{URL::asset('images/professor/'.$professor->prof_image)}}">
		</div>
		<div class="col-md-1"></div>
	</div>
	<div class="col-lg-9">
	
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="form-group">
			<label class="col-md-1">First Name</label>
			<div class="col-md-11">
				<input type="text" class="form-control" name="firstname" value="{{ $professor->prof_firstname }}">
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-1">Last Name</label>
			<div class="col-md-11">
				<input type="text" class="form-control" name="lastname" value="{{ $professor->prof_lastname }}">
			</div>
		</div>

		<br/>
		<div class="form-group">
			<label class="col-md-12">Description</label>
			<div class="col-md-12">
				<textarea class="form-control" name="description" id="description" cols="112"" rows="11">{{$professor->prof_description}}</textarea>
			</div>
		</div>
		
		 <button type="submit" class="btn btn-default">Submit</button>
	</div>
	</form>
</div>

<!-- /.row -->
@stop