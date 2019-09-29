@extends('Papaadmin::admin.layouts.admin')

@section('title')
Roles
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
			  <div class="d-flex justify-content-between">
				<h4>Permissions</h4>
			  	<a class="btn btn-success btn-sm" href="{{route('admin.permissions.create')}}">Create Permission</a>
			  </div>
            <div class="table-responsive pt-5">
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th colspan="1">
                    	Permission
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
					@foreach ($permissions as $permission)
						<tr>
							<td>{{ ucfirst($permission->name)}}</td>
							<td>{{ ucfirst($permission->guard_name)}}</td>
							<td>
								<a class="badge badge-primary" href="{{ route('admin.permissions.edit', ['permission' => $permission->id])}}">edit</a>
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
