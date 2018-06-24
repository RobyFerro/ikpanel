<table id="roles-table" class="table table-valign table-condensed" cellspacing="0" width="100%">
	<colgroup>
		<col style="width: 70px;">
		<col style="width: auto;">
		<col style="width: auto;">
		<col style="width: auto;">
	</colgroup>
	<thead>
	<tr>
		<th>#</th>
		<th>Tipo</th>
		<th>Stato</th>
		<th style="text-align: right">Azione</th>
	</tr>
	</thead>
	<tbody>
	@foreach($roles as $i=>$role)
		<tr>
			<td>{{ $i+1 }}</td>
			<td>{{ $role->group_name }}</td>
			<td>
				@if(is_null($role->deleted_at))
					<i class="fa fa-check-circle fa-fw text-success"></i>
					<span class="text-success text-bold">Attivo</span>
				@else
					<i class="fa fa-times-circle fa-fw text-danger"></i>
					<span class="text-danger text-bold">Disattivo</span>
				@endif
			</td>
			<td style="text-align: right">
				@if(is_null($role->deleted_at))
					<a href="{{admin_url('/roles/edit/'.$role->id)}}"
					   class="btn btn-info btn-sm" style="min-width: 110px;">
						<i class="fas fa-edit fa-fw"></i>
						Modifica
					</a>
					<button class="btn btn-danger btn-sm action-delete" style="min-width: 110px;"
					        data-id="{{ $role->id }}">
						<i class="fas fa-trash-alt fa-fw"></i> Elimina
					</button>
				@else
					<button class="btn btn-success btn-sm action-restore" style="min-width: 110px;"
					        data-id="{{ $role->id }}">
						<i class="fas fa-undo-alt fa-fw"></i> Ripristina
					</button>
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>