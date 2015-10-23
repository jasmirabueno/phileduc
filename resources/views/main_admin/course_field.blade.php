@extends('admin')

@section('navbar')
	@include('main_admin.navbar')
@stop

@section('content')
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Institutions
			@if($is_verified)
			<small>List of Verified Course Categories</small>
			@else
			<small>List of Pending Course Categories</small>
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

@if( $is_verified)
	<div class="row">
		<div class="container col-lg-12">
			<table class="table">
				<thead>
				<tr>
					<th>Category Name</th>
				</tr>
				</thead>
				<tbody>
				@foreach ($accepted_categ as $accepted)
					<tr>
						<td>{{$accepted->categ_name}}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>           
	</div>
@else(! $is_verified)
	<div class="row">
		<div class="container col-lg-12">
			<table class="table">
				<thead>
				<tr>
					<th>Category Name</th>
					<th>Accept</th>
					<th>Decline</th>
				</tr>
				</thead>
				<tbody>
				@foreach ($pending_categ as $pending)
					<tr>
						<td>{{$pending->categ_name}}</td>
						<td>
							<form class="form-horizontal col-lg-1" role="form" method="POST" action="{{ url('/main_admin/accept_categ') }}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">						
								<input type="hidden" name="categ_id" value="{{$pending->id}}">
								<div class="form-group">
										<button type="submit" class="btn btn-primary">
											Accept
										</button>
								</div>								
							</form>	
						</td>
						<td>
							<form class="form-horizontal col-lg-1" role="form" method="POST" action="{{ url('/main_admin/decline_categ') }}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">						
								<input type="hidden" name="categ_id" value="{{$pending->id}}">
								<div class="form-group">
										<button type="submit" class="btn btn-primary">
											Decline
										</button>
								</div>								
							</form>	
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>           
	</div>
@endif


@stop