@extends('ikpanel::dashboard')

@section('title','Nuovo utente')

@section('section_name','Nuovo utente')

@section('initial_link')
	<link media="screen" type="text/css" rel="stylesheet"
	      href="{{ asset('ikpanel/assets/plugins/select2/css/select2.css') }}">
@endsection

@section('before_body')
@endsection

@section('action_navbar')
	@component('ikpanel::components.action_buttons', ['close' => admin_url('/users/')])
	@endcomponent
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						Generali
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-group-default required">
								<label for="name">Nome</label>
								<input class="form-control form-data"
								       id="name"
								       type="text"
								       autocomplete="off">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default required">
								<label for="surname">Cognome</label>
								<input class="form-control form-data"
								       id="surname"
								       type="text"
								       autocomplete="off">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group form-group-default required">
								<label for="mail">Email</label>
								<input class="form-control form-data"
								       id="mail"
								       type="email"
								       autocomplete="off">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-group-default required">
								<label for="password">Password</label>
								<input class="form-control form-data"
								       id="password"
								       type="password"
								       autocomplete="off">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default required">
								<label for="repassword">Ripeti password</label>
								<input class="form-control form-data"
								       id="repassword"
								       type="password"
								       autocomplete="off">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group form-group-default">
								<label>Foto utente</label>
								
								<div class="text-center">
									<div class="avatar-cool">
										<img id="avatar-image"
										     class="avatar-cool-image img img-fluid rounded-circle"
										     @if(!empty($user->avatar))
										     src="{{url($user->avatar)}}"
										     @else
										     src="{{asset('ikpanel/assets/img/profiles/avatar-default.png')}}"
												@endif
										/>
										<div id="avatar-button" class="avatar-cool-edit">
											<i class="fas fa-pencil-alt fa-fw"></i>
										</div>
										<input type="file" id="avatar" class="form-data jhide"
										       accept=".jpg, .png, .jpeg|images/*"
										       autocomplete="off"/>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group form-group-default form-group-default-select2 required">
								<label for="role">Ruolo</label>
								<select id="role"
								        class="full-width select2-hidden-accessible form-data"
								        tabindex="-1"
								        aria-hidden="true"
								        autocomplete="off">
									<option></option>
									@foreach($roles as $role)
										<option value="{{ $role->id }}">{{ $role->group_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
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
	<script type="text/javascript" src="{{ asset('ikpanel/assets/plugins/select2/js/select2.js') }}"></script>
	<script src="{{ asset('ikpanel/plugins/js/users_new.js') }}" type="text/javascript"></script>
	
@endsection