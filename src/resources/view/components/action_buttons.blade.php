<!-- START ecit_admin::components.action_buttons -->
<div class="btn-group">
	<button type="button" class="btn btn-success action-save" data-action="save">
		<i class="fas fa-floppy-o"></i>
		Salva
	</button>
	<button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
			aria-haspopup="true" aria-expanded="false">
		<span class="sr-only">Toggle Dropdown</span>
	</button>
	<div class="dropdown-menu">
		@if(!isset($save_new) || (isset($save_new) && $save_new))
			<a class="dropdown-item action-save" data-action="new" href="#">Salva e nuovo</a>
		@endif
		<a class="dropdown-item action-save" data-action="close" href="#">Salva e chiudi</a>
	</div>
</div>

<a type='button' class="btn btn-danger btn-cons" href="{{ env('IKPANEL_URL') }}{{ $close or '' }}">
	<i class="fa fa-times-circle" aria-hidden="true"></i>
	Chiudi
</a>

{{ $slot }}
<!-- END ecit_admin::components.action_buttons -->