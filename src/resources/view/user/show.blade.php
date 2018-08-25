@extends('ikpanel::dashboard')

@section('title','Gestione utenti')

@section('section_name','Gestione utenti')

@section('initial_link')
	<link type="text/css" rel="stylesheet"
	      href="{{ asset('ikpanel/assets/plugins/jquery-datatable/media/css/jquery.dataTables.css') }}">
	<link type="text/css" rel="stylesheet"
	      href="{{ asset('ikpanel/assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css') }}">
	<link media="screen" type="text/css" rel="stylesheet"
	      href="{{ asset('ikpanel/assets/plugins/datatables-responsive/css/datatables.responsive.css') }}">
	{!! css('ikpanel/assets/plugins/select2/css/select2.css') !!}
@endsection

@section('before_body')
@endsection

@section('action_navbar')
	<div class="row action-navbar" id="action-navbar">
		<div class="col-md-12">
			<a type="button" href="{{admin_url('/users/new')}}" class="btn btn-primary btn-sm">
				<i class="fas fa-plus fa-fw"></i>
				Nuovo utente
			</a>
			
			<a type='button' class="btn btn-danger btn-sm" href="{{admin_url()}}">
				<i class="fa fa-times-circle fa-fw" aria-hidden="true"></i>
				Chiudi
			</a>
		</div>
	</div>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-4">
			<div class="form-group form-group-default ">
				<label for="search-filter">Cerca</label>
				<input type="text" class="form-control" id="search-filter">
			</div>
		</div>
		<div class="col-md-5"></div>
		<div class="col-md-3">
			<div class="form-group form-group-default form-group-default-select2">
				<label for="status-filter">Filtro per stato</label>
				<select id="status-filter" class="full-width select2-hidden-accessible" tabindex="-1" aria-hidden="true" autocomplete="off">
					<option value="ALL">Tutti</option>
					<option value="ACTIVE" selected>Attivi</option>
					<option value="DELETED">Eliminati</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12" id="table-content">
			@component('ikpanel::user.table',['users'=>$users])
			@endcomponent
		</div>
	</div>
@endsection

@section('final_script')
	<script type="text/javascript"
	        src="{{ asset('ikpanel/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript"
	        src="{{ asset('ikpanel/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
	<script type="text/javascript"
	        src="{{ asset('ikpanel/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js') }}"></script>
	<script src="{{ asset('ikpanel/assets/plugins/datatables-responsive/js/datatables.responsive.js') }}"
	        type="text/javascript"></script>
	<script src="{{ asset('ikpanel/assets/plugins/datatables-responsive/js/lodash.min.js') }}"
	        type="text/javascript"></script>
	{!! script('ikpanel/assets/plugins/select2/js/select2.js') !!}
	<script src="{{ asset('ikpanel/plugins/js/users_show.js') }}" type="text/javascript"></script>
@endsection