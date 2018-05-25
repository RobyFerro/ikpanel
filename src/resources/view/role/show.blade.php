@extends('ikpanel::dashboard')

@section('title', 'Gestione permessi')

@section('section_name', 'Gestione permessi')

@section('initial_link')

@endsection

@section('before_body')

@endsection

@section('action_navbar')
	<div class="row action-navbar" id="action-navbar">
		<div class="col-md-12">

			<a type="button" href="{{env('IKPANEL_URL')}}/roles/new" class="btn btn-primary btn-sm">
				<i class="fas fa-plus fa-fw"></i>
				Aggiungi ruolo
			</a>

			<a type='button' class="btn btn-danger btn-sm" href="{{env('IKPANEL_URL')}}">
				<i class="fa fa-times-circle fa-fw" aria-hidden="true"></i>
				Chiudi
			</a>
		</div>
	</div>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label>Cerca</label>
				<input type="text" id="search-table" class="form-control pull-right" placeholder="Search">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table id="ruoli" class="table table-condensed dataTable" cellspacing="0" width="100%">
				<thead>
				<tr>
					<th>Tipo</th>
					<th>Stato</th>
					<th style="text-align: right">Azione</th>
				</tr>
				</thead>
				<tbody>
				@foreach($roles as $role)
					<tr>
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
							<a href="{{env('IKPANEL_URL')}}/roles/edit/{{ $role->id }}"
							   class="btn btn-info btn-sm">
								<i class="fas fa-edit fa-fw"></i>
								Modifica
							</a>
							<button class="btn btn-danger btn-small action-delete" data-id="{{ $role->id }}">
								<i class="fas fa-trash-alt fa-fw"></i> Elimina
							</button>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection

@section('final_script')
	<script type="text/javascript" src="{{ asset('ikpanel/plugins/js/role_show.js') }}?{{ time() }}"></script>
@endsection