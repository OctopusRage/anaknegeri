<div class="row">
	<div class="col-md-4">
		<img class="img-thumbnail" @if($user->profile_img!=null) src="{{ asset('img/avatars/')}}/{{ $user->profile_img }}" @else src="{{ asset('img/bg-primary.png' )}}"  @endif >
	</div>
	<div class="col-md-8">
		<table class="table table-bordered table-striped">
			<thead class="thead-inverse">
				<tr>
					<th>ID</th>
					<th>{{ $user->id }}</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Judul</td>
					<td>{{ $user->name }}</td>
				</tr>
				<tr>
					<td>Email</td>
					<td>{{ $user->email }}</td>
				</tr>
				<tr>
					<td>Status</td>
					<td>{{ $user->getStatus() }}</td>
				</tr>
				<tr>
					<td>Role</td>
					<td class="h6">
						@foreach($user->roles as $role)
							<strong class="text-primary text-capitalize">{{$role->name}}</strong><br>
						@endforeach
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>