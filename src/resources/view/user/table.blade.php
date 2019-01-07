<table id="users-table" class="table table-valign table-condensed" cellspacing="0" width="100%">
	<colgroup>
		<col style="width: 50px;">
		<col style="width: auto;">
		<col style="width: auto;">
		<col style="width: auto;">
		<col style="width: 100px;">
		<col style="width: 280px;">
	</colgroup>
	<thead>
	<tr>
		<th>#</th>
		<th>{{ __('users.show.table.name') }}</th>
		<th>{{ __('users.show.table.surname') }}</th>
		<th>{{ __('users.show.table.email') }}</th>
		<th>{{ __('users.show.table.status') }}</th>
		<th style="text-align: right">{{ __('users.show.table.actions') }}</th>
	</tr>
	</thead>
	<tbody>
	@foreach($users as $i=>$user)
		<tr>
			<td>{{ ($i+1) }}</td>
			<td>{{ $user->name }}</td>
			<td>{{ $user->surname }}</td>
			<td>{{ $user->email }}</td>
			<td class="text-center">
				@if(is_null($user->deleted_at))
					<span class="fa-stack" data-toggle="tip" title="{{ __('users.show.filters.active') }}" style="font-size: 10px;">
						<i class="fas fa-circle fa-stack-2x"></i>
						<i class="fas fa-check fa-stack-1x fa-inverse"></i>
					</span>
				@else
					<span class="fa-stack" data-toggle="tip" title="{{ __('users.show.filters.deleted') }}" style="font-size: 10px;">
						<i class="fas fa-circle fa-stack-2x"></i>
						<i class="fas fa-trash-alt fa-stack-1x fa-inverse"></i>
					</span>
				@endif
			</td>
			<td style="text-align: right;">
				@if(is_null($user->deleted_at))
					<a href="{{admin_url('/users/edit/'.$user->id)}}"
					   class="btn btn-info btn-sm" style="min-width: 110px;">
						<i class="fas fa-edit fa-fw"></i>
						{{ __('users.show.buttons.edit') }}
					</a>
					<button class="btn btn-danger btn-sm action-delete" style="min-width: 110px;"
					        data-id="{{ $user->id }}">
						<i class="fas fa-trash-alt fa-fw"></i>
						{{ __('users.show.buttons.delete') }}
					</button>
				@else
					<button class="btn btn-success btn-sm action-restore" style="min-width: 110px;"
					        data-id="{{ $user->id }}">
						<i class="fas fa-undo-alt fa-fw"></i>
						{{ __('users.show.buttons.restore') }}
					</button>
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>