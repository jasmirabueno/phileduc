@extends('admin')

@section('navbar')
	@include('professor.navbar')
@stop

@section('content')
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Add Lecture			
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('professor/add-lecture') }}" enctype="multipart/form-data">
						
						<input type="hidden" name="course_id" value="{{ $course->id }}">
						<!--
						<input type="hidden" name="_token" value="{{ csrf_token() }}">	
						-->
						{!! csrf_field() !!}
						<div class="form-group">
							<label class="col-md-1 control-label">Title</label>
							<div class="col-md-11">
								<input type="text" class="form-control" name="lecture_name" value="{{ old('lecture_name') }}">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-1 control-label">Video</label>
							<div class="col-md-11">
								<input type="file" class="form-control" name="video" >
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-12">Description</label>
							<div class="col-md-12">
								<textarea class="form-control" name="lecture_description" id="description" cols="82"" rows="11"></textarea>
							</div>
						</div>
											


						<div class="form-group">
							<div class="col-md-11 col-md-offset-10">
								<button type="submit" class="btn btn-primary">
									Add Lecture
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
</div>
<!-- /.row -->
@stop