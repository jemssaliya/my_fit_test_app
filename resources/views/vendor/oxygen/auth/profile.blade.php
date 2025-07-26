@extends('oxygen::layouts.master-dashboard')

@section('content')
<div class="container-fluid">
	<div class="row">
        <div class="col-md-12">

			<div class="title-container">
				<div class="page-title">
					<h1>My Profile</h1>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<span class="text-strong">Edit Profile</span>
				</div>
				<div class="card-body">

					<form class="form-horizontal" role="form" method="POST" action="{{ route('account.profile') }}">
						{{ method_field('put') }}
						@csrf

						@if ($user->name)
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-2 col-form-label">First Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="name"
										   name="name" placeholder="First Name"
										   value="{{ old('name', $user->name) }}">
								</div>
							</div>
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-2 col-form-label">Last Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="last_name"
										   name="last_name" placeholder="Last Name"
										   value="{{ old('last_name', $user->last_name) }}">
								</div>
							</div>
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-2 col-form-label">Phone</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="phone"
										   name="phone" placeholder="First Name"
										   value="{{ old('phone', $user->phone) }}">
								</div>
							</div>
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="email"
										   name="email" placeholder="Email"
										   value="{{ old('email', $user->email) }}" disabled>
								</div>
							</div>
						@endif

						<hr>
						<div class="form-group row">
							<div class="col-sm-10 offset-2">
								<button type="submit" class="btn btn btn-success btn-lg btn-wide ">
									Update Profile
								</button>
							</div>
						</div>

					</form>
				</div>
			</div>

        </div>
	</div>
</div>
@endsection
