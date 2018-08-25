@extends('ikpanel::dashboard')

@section('title','Il mio account')

@section('section_name','Il mio account')

@section('initial_link')
@endsection

@section('before_body')
@endsection

@section('action_navbar')
	<div class="row action-navbar" id="action-navbar">
		<div class="col-md-12">
			@component('ikpanel::components.action_buttons',['save_new'=>false,'close'=>admin_url()])
			@endcomponent
		</div>
	</div>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-7">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group form-group-default">
						<label>Nome</label>
						<span>{{$user->name}}</span>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group form-group-default">
						<label>Cognome</label>
						<span>{{$user->surname}}</span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group form-group-default">
						<label>Email</label>
						<span>{{$user->email}}</span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group form-group-default">
						<label for="password">Password</label>
						<input type="password" id="password" class="form-control form-data">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group form-group-default">
						<label for="rpassword">Ripeti password</label>
						<input type="password" id="rpassword" class="form-control form-data">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-2"></div>
		<div class="col-md-3">
			<div class="form-group form-group-default">
				<label>Foto utente</label>
				
				<div class="text-center">
					<div class="avatar-cool">
						<img id="avatar-image"
						     class="avatar-cool-image img img-fluid rounded-circle"
						     @if(!empty($user->avatar))
						     src="{{url($user->avatar)}}"
						     @else
						     src="{{asset('ecit/assets/img/profiles/avatar-default.png')}}"
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
	</div>
@endsection

@section('final_script')
	<script src="{{ asset('ikpanel/plugins/js/profile.js')}}"></script>
@endsection