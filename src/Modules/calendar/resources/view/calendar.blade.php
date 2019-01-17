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

@section('final_script')
	{!! script('ikpanel/modules/calendar/js/plugins/fullcalendar-3.10.0/lib/moment.min.js') !!}
	{!! script('ikpanel/modules/calendar/js/plugins/fullcalendar-3.10.0/fullcalendar.min.js') !!}
	{!! script('ikpanel/modules/calendar/js/plugins/fullcalendar-3.10.0/locale/it.js') !!}
	{!! script('ikpanel/modules/calendar/js/calendar.js',true) !!}
@endsection
