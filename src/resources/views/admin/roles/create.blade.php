@extends('Papaadmin::admin.layouts.admin')

@section('title')
Create Role
@endsection

@section('head-assests')
<link rel="stylesheet" href="{{asset('staradmin/vendor/select2/css/select2.min.css')}}">
<script src="{{asset('staradmin/vendor/select2/js/select2.full.min.js')}}"></script>
@endsection
@section('content')
<div class="col-md-8 col-sm-12 grid-margin stretch-card">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title"><b>Create New Role</b></h4>
			<form class="forms-sample" method="POST" action="{{route('admin.roles.store')}}">
			  	@csrf
			  	<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" placeholder="Name">
					@error('name') 
						<small class="invalid-feedback" role="alert">{{$message}}</small>
					@enderror
				</div>
				<div class="form-group">
					<label for="name">Permissions</label>
					<select name="permissions[]" class="js-example-basic-multiple form-control @error('name') is-invalid @enderror" multiple>
						@foreach ($permissions as $one)
							<option value="test">test</option>
							<option value="{{$one->name}}">{{$one->name}}</option>
						@endforeach
					</select>
					@error('permissions.*.name') 
						<small class="invalid-feedback" role="alert">{{$message}}</small>
					@enderror
				</div>
				<button type="submit" class="btn btn-success mr-2">Submit</button>
			  	<button class="btn btn-light">Cancel</button>
			</form>
		</div>
	</div>
</div>
@endsection

@section('body-assests')
	<script>
		$(document).ready(function(){
			$('.js-example-basic-multiple').select2();
		});
	</script>
@endsection
