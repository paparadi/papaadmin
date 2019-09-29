
<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<style>
		::-webkit-scrollbar{
			width: 0;
			background: transparent;
		}
	</style>
		<ul class="nav">
			<li class="nav-item nav-profile">
				<div class="nav-link">
					<div class="user-wrapper">
						<div class="profile-image">
						<img src="@if(auth('admin')->user()->image) {{'/storage/'.auth('admin')->user()->image}} @else {{'/staradmin/images/faces-clipart/pic-1.png'}} @endif" alt="profile image">
						</div>
						<div class="text-wrapper">
							<p class="profile-name">{{ ucwords(Auth::guard('admin')->user()->name)}}</p>
							<div>
								<small class="designation text-muted">{{ ucwords(Auth::guard('admin')->user()->getRoleNames()->first())}}</small>
								<span class="status-indicator online"></span>
							</div>
						</div>
					</div>
					{{-- <button class="btn btn-success btn-block">New Project
						<i class="mdi mdi-plus"></i>
					</button> --}}
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{route('admin.dashboard')}}">
					<i class="menu-icon mdi mdi-television"></i>
					<span class="menu-title">Dashboard</span>
				</a>
			</li>

			@can('manage_users')
			<li class="nav-item">
				<a class="nav-link" data-toggle="collapse" href="#users" aria-expanded="false" aria-controls="auth">
					<i class="menu-icon mdi mdi-backup-restore"></i>
                    <span class="menu-title">Manage Users</span>
                    <i class="menu-arrow"></i>
				</a>
				<div class="collapse" id="users">
					<ul class="nav flex-column sub-menu">
						<li class="nav-item">
							<a class="nav-link" href="{{route('admin.users.index')}}">Users</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{route('admin.roles.index')}}">Roles</a>
						</li>
						@can('manage_permissions')
						<li class="nav-item">
							<a class="nav-link" href="{{route('admin.permissions.index')}}">Permissions</a>
						</li>
						@endcan
					</ul>
				</div>
			</li>
            @endcan
		</ul>
	</nav>
