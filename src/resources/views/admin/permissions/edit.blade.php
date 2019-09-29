@extends('Papaadmin::admin.layouts.admin')

@section('title')
Edit Permission
@endsection

@section('content')
<div class="col-md-8 col-sm-12 grid-margin stretch-card">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title"><b>Edit Permission</b></h4>
			<form class="forms-sample" method="POST" action="{{route('admin.permissions.update', ['permission'=>$permission])}}">
				@csrf
				@method('PUT')  
			  	<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name') ?? $permission->name}}" placeholder="Name">
					@error('name') 
						<small class="invalid-feedback" role="alert">{{$message}}</small>
					@enderror
				</div>
				<button type="submit" class="btn btn-success mr-2">Submit</button>
			  	<button class="btn btn-light btn-cancel">Cancel</button>
			</form>
		</div>
	</div>
</div>
@endsection