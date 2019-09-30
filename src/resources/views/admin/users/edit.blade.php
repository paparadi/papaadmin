@extends('Papaadmin::admin.layouts.admin')

@section('title')
Edit User
@endsection

@section('content')
<div class="col-md-8 col-sm-12 grid-margin stretch-card">
		<div class="card">
		  <div class="card-body">
			<h4 class="card-title"><b>Edit User</b></h4>
			<form class="forms-sample" method="POST" action="{{route('admin.users.update', ['user' => $user->id])}}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
			  <div class="form-group">
				<label for="name">Name</label>
				<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name') ?? $user->name}}" placeholder="Name">
				@error('name') 
					<small class="invalid-feedback" role="alert">{{$message}}</small>
				@enderror
			  </div>
			  <div class="form-group">
				<label for="email">Email address</label>
				<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email') ?? $user->email}}" placeholder="Email">
				@error('email') 
					<small class="invalid-feedback" role="alert">{{$message}}</small>
				@enderror
			  </div>
			  <div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
				@error('password') 
					<small class="invalid-feedback" role="alert">{{$message}}</small>
				@enderror
			  </div>
			  <div class="form-group">
				<label for="confirm password">Confirm Password</label>
				<input type="password" class="form-control @error('password') is-invalid @enderror" id="confirm password" name="confirm password" placeholder="Password">
				@error('password') 
					<small class="invalid-feedback" role="alert">{{$message}}</small>
				@enderror
			  </div>
			  	<div class="form-group">
					<label for="role">Role</label>
					<select class="form-control @error('role') is-invalid @enderror" id="role" name="role">
						<option value=""></option>
						@foreach ($roles as $role)
						<option value="{{$role->name}}" @if($role->name == old('role') || $role->name == $user->getRoleNames()->first()) {{'selected'}} @endif>{{$role->name}}</option>
						@endforeach
					</select>
					@error('role') 
						<small class="invalid-feedback" role="alert">{{$message}}</small>
					@enderror
				</div>
			  <div class="form-group">
				<label>Image</label>
				<input type="file" name="image" value="{{old('image') ?? $user->image}}" id="image" class="file-upload-default">
				<div class="input-group col-xs-12">
				  <input type="text" id="temp-upload" class="form-control file-upload-info @error('image') is-invalid @enderror" disabled placeholder="Upload Image">
				  <span class="input-group-append">
					<button class="file-upload-browse btn btn-info" onclick="myFunction()" type="button">Upload</button>
					<script>
						function myFunction(){
							$('input#image').click();
							//console.log($('input#image').val());
						}
						$(document).ready(function(){
							$('input#image').change(function(){
								var file_name = $('input#image').val();
								file_name = file_name.split('\\');
								var name = file_name[file_name.length-1];
								$('input#temp-upload').val(name);
							});
						});
					</script>
				  </span>
				  @error('image') 
					  <small class="invalid-feedback" role="alert">{{$message}}</small>
				  @enderror
				</div>
			</div>
			<div class="form-group">
				<label for="status">Status</label>
				<select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
					<option value=""></option>
					<option value="0" @if(!old('status')) {{'selected'}} @elseif(!$user->status) {{'selected'}} @endif>Disabled</option>
					<option value="1" @if(old('status')) {{'selected'}} @elseif($user->status) {{'selected'}} @endif>Active</option>
				</select>
				@error('status') 
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
