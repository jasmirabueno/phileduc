@extends('admin')

@section('navbar')
	@include('inst_admin.navbar')
@stop

@section('content')
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Add Course			
		</h1>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('institution/add-course') }}" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
												
						<div class="form-group">
							<label class="col-md-1 control-label">Title</label>
							<div class="col-md-11">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-1 control-label">Image</label>
							<div class="col-md-11">
								<input type="file" class="form-control" name="image" >
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-12">Description</label>
							<div class="col-md-12">
								<textarea class="form-control" name="description" id="description" cols="82"" rows="11">{{ old('description') }}</textarea>
							</div>
						</div>
											
						
						<div class="form-group">
							<label class="col-md-2 control-label">Professor Assigned</label>
							<div class="col-md-10">
								<select class="btn btn-default dropdown-toggle" name="professor">
									<option value="" selected>--Select Professor--</option>
									@foreach($professors_verified as $professor)
										<option value="{{$professor->prof_id}}">{{$professor->prof_firstname." ".$professor->prof_lastname}}</option>
									@endforeach
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label">Course Category</label>
							<div class="col-md-10">
								<select class="btn btn-default dropdown-toggle" name="category">
									<option value="" selected>--Select Course Category--</option>
									@foreach($categories as $category)
										<option value="{{$category->categ_name}}">{{$category->categ_name}}</option>
									@endforeach
								</select>
							</div>
						</div>


						<div class="form-group">
							<div class="col-md-11 col-md-offset-10">
								<button type="submit" class="btn btn-primary">
									Add Course
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
</div>
<!-- /.row -->
@stop