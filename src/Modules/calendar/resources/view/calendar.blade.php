@extends('ikpanel::dashboard')

@section('title')
	{{ __('ikpanel-calendar::calendar.show.titleName') }}
@endsection

@section('section_name')
	{{ __('ikpanel-calendar::calendar.show.sectionName') }}
@endsection

@section('initial_link')
	{!! css('ikpanel/modules/calendar/js/plugins/fullcalendar-3.10.0/fullcalendar.css') !!}
@endsection

@section('before_body')
@endsection

@section('action_navbar')
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
	<div class="modal fade slide-right disable-scroll" id="event" tabindex="-1" role="dialog"
	     aria-labelledby="modelTitleId" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">
						{{ __('ikpanel-calendar::calendar.show.newEventModalTitle') }}
					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Body
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">
						{{ __('ikpanel-calendar::calendar.show.buttons.closeEventModal') }}
					</button>
					<button type="button" class="btn btn-primary">
						{{ __('ikpanel-calendar::calendar.show.buttons.saveEventModal') }}
					</button>
				</div>
			</div>
		</div>
	</div>
@endpush

@section('final_script')
	{!! script('ikpanel/modules/calendar/js/plugins/fullcalendar-3.10.0/lib/moment.min.js') !!}
	{!! script('ikpanel/modules/calendar/js/plugins/fullcalendar-3.10.0/fullcalendar.min.js') !!}
	{!! script('ikpanel/modules/calendar/js/plugins/fullcalendar-3.10.0/locale/it.js') !!}
	{!! script('ikpanel/modules/calendar/js/calendar.js',true) !!}
@endsection
