@extends('Papaadmin::admin.layouts.admin')

@section('title')
Users
@endsection

@section('content')

<div class="col-lg-12 grid-margin stretch-card">
	<div class="card">
		<div class="card-body">
			<div class="d-flex justify-content-between">
				<h4>Users</h4>
				<a class="btn btn-success btn-sm" href="{{route('admin.users.create')}}">Create User	</a>
			</div>
			<div class="table-responsive pt-5">
				<table class="table table-striped table-sm">
					<thead>
						<tr>
							<th>
								
							</th>
							<th>
								Name
							</th>
							<th>
								Email
							</th>
							<th>
								Role
							</th>
							<th>
								Action
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
							<tr>
								<td class="py-1">
									<img src="@if($user->image) {{'/storage/'.$user->image}} @else {{'/staradmin/images/faces-clipart/pic-1.png'}} @endif" alt="image" />
								</td>
								<td>{{$user->name}}</td>
								<td>{{$user->email}}</td>
								<td>{{$user->getRoleNames()->first()}}</td>
								<td>
									<a class="badge badge-primary" href="{{ route('admin.users.edit', ['user' => $user->id])}}">edit</a>
									<a class="badge badge-danger" href="{{ route('admin.users.destroy', ['user' => $user->id])}}">delete</a>
								</td>
							</tr>	
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
