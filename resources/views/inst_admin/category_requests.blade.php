@extends('admin')

@section('navbar')
		@include('inst_admin.navbar')	
@stop

@section('content')
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Category Request
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
<br/>
<br/>
<form class="form-horizontal" role="form" method="POST" action="{{ url('institution/categ_requests') }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<div class="form-group">
		<label class="col-md-4 control-label">Course Category</label>
		<div class="col-md-6">
			<input type="text" class="form-control" name="name" value="">
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6 col-md-offset-4">
			<button type="submit" class="btn btn-primary">Send Request</button>
		</div>
	</div>
</form>
@stop