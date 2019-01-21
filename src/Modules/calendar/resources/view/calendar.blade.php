@extends('ikpanel::dashboard')

@section('title')
	{{ __('ikpanel-calendar::calendar.show.titleName') }}
@endsection

@section('section_name')
	{{ __('ikpanel-calendar::calendar.show.sectionName') }}
@endsection

@section('initial_link')
	{!! css('ikpanel/assets/plugins/select2/css/select2.css') !!}
	{!! css('ikpanel/modules/calendar/js/plugins/fullcalendar-3.10.0/fullcalendar.css') !!}
	{!! css('ikpanel/assets/plugins/bootstrap-datepicker-new/css/bootstrap-datepicker3.css') !!}
@endsection

@section('before_body')
@endsection

@section('action_navbar')
	<div class="row action-navbar" id="action-navbar">
		<div class="col-md-6">
			<button type="button" id="new-event" class="btn btn-primary btn-sm">
				<i class="fas fa-plus fa-fw"></i>
				{{ __('ikpanel-calendar::calendar.show.buttons.newEvent') }}
			</button>
			<a type='button' class="btn btn-danger btn-sm" href="{{admin_url()}}">
				<i class="fa fa-times-circle fa-fw" aria-hidden="true"></i>
				{{ __('ikpanel-calendar::calendar.show.buttons.close') }}
			</a>
		</div>
	</div>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						{{ __('ikpanel-calendar::calendar.show.contentTitle') }}
					</div>
				</div>
				<div class="card-body">
					<div id="calendar" class="full-height"></div>
				</div>
			</div>
		
		</div>
	</div>
@endsection

@push('modal-container')
	<!-- Modal -->
	<div class="modal fade slide-up" id="event" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-xl">
			<div class="modal-content-wrapper">
				<div class="modal-content">
					<div class="modal-body">
						<input type="hidden">
						<div class="row">
							<div class="col-md-7">
								<h5>
									{{ __('ikpanel-calendar::calendar.show.modal.title') }}
								</h5>
								<div id="event-modal-editor">
									<div class="form-group form-group-default">
										<input type="text"
										       id="event-modal-title"
										       class="form-control form-control-lg"
										       placeholder="{{ __('ikpanel-calendar::calendar.show.modal.placeholders.eventName') }}"
										       autocomplete="off">
									</div>
									<div class="form-group form-group-default">
										<input type="text"
										       id="event-modal-location"
										       class="form-control"
										       placeholder="{{ __('ikpanel-calendar::calendar.show.modal.placeholders.location') }}"
										       autocomplete="off">
									</div>
									<div class="row no-gutters mb-1">
										<div class="col-md-5 pr-2">
											<div class="input-group input-group-prepend-lite">
												<div class="input-group-prepend">
												<span class="input-group-text border-radius-left-pages"
												      style="min-width: 70px;">
													{{ __('ikpanel-calendar::calendar.show.modal.labels.startDate') }}
												</span>
												</div>
												<input type="text" id="event-modal-start-date" class="form-control"
												       autocomplete="off">
												<div class="input-group-append">
												<span class="input-group-text border-radius-right-pages">
													<i class="fas fa-calendar-alt"></i>
												</span>
												</div>
											</div>
										</div>
										<div class="col-md-4 pr-2">
											<div class="input-group">
												<input type="text" id="event-modal-start-time" class="form-control"
												       autocomplete="off">
												<div class="input-group-append">
												<span class="input-group-text border-radius-right-pages">
													<i class="fas fa-clock"></i>
												</span>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="checkbox check-default">
												<input type="checkbox" id="event-modal-allday" autocomplete="off">
												<label for="event-modal-allday">
													{{ __('ikpanel-calendar::calendar.show.modal.labels.allDay') }}
												</label>
											</div>
										</div>
									</div>
									
									<div class="row no-gutters mb-2">
										<div class="col-md-5 pr-2">
											<div class="input-group input-group-prepend-lite">
												<div class="input-group-prepend">
												<span class="input-group-text border-radius-left-pages"
												      style="min-width: 70px;">
													{{ __('ikpanel-calendar::calendar.show.modal.labels.endDate') }}
												</span>
												</div>
												<input type="text" id="event-modal-end-date" class="form-control"
												       autocomplete="off">
												<div class="input-group-append">
												<span class="input-group-text border-radius-right-pages">
													<i class="fas fa-calendar-alt"></i>
												</span>
												</div>
											</div>
										</div>
										<div class="col-md-4 pr-2">
											<div class="input-group">
												<input type="text" id="event-modal-end-time" class="form-control"
												       autocomplete="off">
												<div class="input-group-append">
												<span class="input-group-text border-radius-right-pages">
													<i class="fas fa-clock"></i>
												</span>
												</div>
											</div>
										</div>
										<div class="col-md-3"></div>
									</div>
									
									<div class="form-group">
									<textarea class="form-control" id="event-modal-note"
									          placeholder="{{ __('ikpanel-calendar::calendar.show.modal.placeholders.eventContent') }}"
									          autocomplete="off"
									          style="height: 240px;resize: none;"></textarea>
									</div>
								
								</div>
								
								<div id="event-modal-readonly" style="display: none;"></div>
							
							</div>
							<div class="col-md-5">
								<h5>{{ __('ikpanel-calendar::calendar.show.modal.labels.people') }}</h5>
								<div id="event-modal-add-attendees">
									<div class="input-group input-group-double-select-append">
										<select id="event-modal-invite" class="form-control" autocomplete="off">
											<option></option>
										</select>
										<div class="input-group-append">
											<select id="event-modal-invite-type"
											        class="form-control"
											        autocomplete="off">
												<option value="USERS">
													{{ __('ikpanel-calendar::calendar.show.modal.options.users') }}
												</option>
												<option value="CUSTOM">
													{{ __('ikpanel-calendar::calendar.show.modal.options.custom') }}
												</option>
											</select>
										</div>
									</div>
									<hr>
								</div>
								<div class="scrollable">
									<div id="event-modal-people" style="max-height: 380px;"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer text-right">
						<button type="button" class="btn btn-default" data-dismiss="modal">
							<i class="fas fa-close fa-fw"></i>
							{{ __('ikpanel-calendar::calendar.show.modal.buttons.close') }}
						</button>
						<button type="button" class="btn btn-danger" style="display: none;" id="event-modal-delete">
							<i class="fas fa-trash-alt fa-fw"></i>
							{{ __('ikpanel-calendar::calendar.show.modal.buttons.delete') }}
						</button>
						<button type="button" class="btn btn-primary" id="event-modal-save">
							<i class="fas fa-save fa-fw"></i>
							{{ __('ikpanel-calendar::calendar.show.modal.buttons.save') }}
						</button>
					</div>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
	</div>
@endpush

@section('final_script')
	{!! script('ikpanel/assets/plugins/bootstrap-datepicker-new/js/bootstrap-datepicker.js') !!}
	{!! script('ikpanel/assets/plugins/bootstrap-datepicker-new/locales/bootstrap-datepicker.it.min.js') !!}
	{!! script('ikpanel/assets/plugins/ckeditor/ckeditor.js') !!}
	{!! script('ikpanel/assets/plugins/ckeditor/adapters/jquery.js') !!}
	{!! script('ikpanel/assets/plugins/select2/js/select2.js') !!}
	{!! script('ikpanel/modules/calendar/js/plugins/fullcalendar-3.10.0/lib/moment.min.js') !!}
	{!! script('ikpanel/modules/calendar/js/plugins/fullcalendar-3.10.0/fullcalendar.min.js') !!}
	{!! script('ikpanel/modules/calendar/js/plugins/fullcalendar-3.10.0/locale/it.js') !!}
	{!! script('ikpanel/assets/plugins/jquery-mask/jquery.mask.min.js') !!}
	{!! script('ikpanel/modules/calendar/js/calendar.js',true) !!}
@endsection
