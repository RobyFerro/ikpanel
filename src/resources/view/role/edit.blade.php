@extends('ikpanel::dashboard')

@section('title', 'Modifica ruolo')

@section('section_name', 'Modifica ruolo')

@section('initial_link')
	<link media="screen" type="text/css" rel="stylesheet"
		  href="{{ asset('plugins/switchery/css/switchery.min.css') }}">
@endsection

@section('before_body')

@endsection

@section('action_navbar')
	<div class="row action-navbar" id="action-navbar">
		<div class="col-md-12">

			@component('ikpanel::components.action_buttons',['close'=>'/roles/','save_new'=>false])
			@endcomponent
		</div>
	</div>
@endsection

@section('content')
	<h4>Dettagli</h4>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group form-group-default required">
				<label>Nome</label>
				<input type="text"
					   id="role_name"
					   class="form-control dati-utente"
					   value="{{ $role->group_name }}"
					   autocomplete="off">
				<input type="hidden" id="role_id" value="{{$role->id}}"/>
			</div>
		</div>
	</div>

	<table class="table table-bordered table-condensed">
		<thead>
		<tr>
			<th class="header-white">Permessi</th>
		</tr>
		</thead>
		<tbody>

		@foreach($groups as $group)

			<tr class="header-row">
				<td>{{ $group->group_name }}</td>
			</tr>
			@foreach($group->token as $token)
				<tr>
					<td>
						<div class="checkbox check-default" style="margin:0;">
							<input type="checkbox"
								   class="data-permissions"
								   id="permission-{{ $token->id }}"
								   data-id="{{ $token->id }}"
								   {{ $token->isChecked or '' }}
								   autocomplete="off">
							<label for="permission-{{  $token->id }}">
								<span class="text-bold" style="vertical-align: top !important;">{{  $token->description }}</span>
							</label>
						</div>
					</td>
				</tr>

				@foreach($token->children as $child)
					<tr>
						<td style="padding-left: 40px !important;">
							<div class="checkbox check-default" style="margin:0;">
								<input type="checkbox"
									   class="data-permissions"
									   id="permission-{{ $child->id }}"
									   data-id="{{ $child->id }}"
									   {{ $child->isChecked or '' }}
									   autocomplete="off">
								<label for="permission-{{  $child->id }}">
									<span class="text-bold" style="vertical-align: top !important;">{{  $child->description }}</span>
								</label>
							</div>
						</td>
					</tr>
				@endforeach

			@endforeach


		@endforeach

		</tbody>
	</table>

@endsection

@section('final_script')
	<script src="{{ asset('ikpanel/assets/js/jquery.redirect.js') }}"></script>
	<script type="text/javascript"
			src="{{ asset('ikpanel/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript"
			src="{{ asset('ikpanel/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
	<script type="text/javascript"
			src="{{ asset('ikpanel/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js') }}"></script>
	<script type="text/javascript"
			src="{{ asset('ikpanel/assets/plugins/datatables-responsive/js/datatables.responsive.js') }}"></script>
	<script type="text/javascript"
			src="{{ asset('ikpanel/assets/lugins/datatables-responsive/js/lodash.min.js') }}"></script>
	<script type="text/javascript"
			src="{{ asset('ikpanel/assets/plugins/switchery/js/switchery.min.js') }}"></script>
	<script type="text/javascript"
			src="{{ asset('ikpanel/plugins/js/role_edit.js') }}?{{ time() }}"></script>
@endsection