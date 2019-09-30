@extends('Papaadmin::admin.layouts.admin')

@section('title')
Roles
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
			  <div class="d-flex justify-content-between">
				<h4>Roles</h4>
			  	<a class="btn btn-success btn-sm" href="{{route('admin.roles.create')}}">Create Role</a>
			  </div>
            <div class="table-responsive pt-5">
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th colspan="1">
                      	Role
					</th>
					<th colspan="1">
						Guard
					</th>
                    <th colspan="1">
						Action
                    </th>
                  </tr>
                </thead>
                <tbody>
					@foreach ($roles as $role)
						<tr>
							<td>{{ ucfirst($role->name)}}</td>
							<td>{{ ucfirst($role->guard_name)}}</td>
							<td>
								<a class="badge  badge-primary" href="{{ route('admin.roles.edit', ['role' => $role->id])}}">edit</a>
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
