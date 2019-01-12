<!-- START ikpanel::components.action_buttons -->
<div class="btn-group">
	<button type="button" class="btn btn-success action-save" data-action="save">
		<i class="fas fa-floppy-o"></i>
		{{ __('ikpanel::action-button.buttons.save') }}
	</button>
	<button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
	        aria-haspopup="true" aria-expanded="false">
		<span class="sr-only">Toggle Dropdown</span>
	</button>
	<div class="dropdown-menu">
		@if(!isset($save_new) || (isset($save_new) && $save_new))
			<a class="dropdown-item action-save" data-action="new" href="#">
				{{ __('ikpanel::action-button.buttons.save') }}
			</a>
		@endif
		<a class="dropdown-item action-save" data-action="close" href="#">
			{{ __('ikpanel::action-button.buttons.saveAndNew') }}
		</a>
	</div>
</div>

<a type='button' class="btn btn-danger btn-cons" href="{{ $close or '#' }}">
	<i class="fa fa-times-circle" aria-hidden="true"></i>
	{{ __('ikpanel::action-button.buttons.close') }}
</a>

{{ $slot }}
<!-- END ikpanel::components.action_buttons -->