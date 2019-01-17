import 'fullcalendar';

$(function () {
	let calendarContainer = $('#calendar'),
		modalEvent = $('#event'),
		modalEventTitle = $('#modalEventTitle');
	
	calendarContainer.fullCalendar({
		eventSources: [
			//
		],
		locale: 'it',
		showNonCurrentDates: false,
		slotDuration: "00:30",
		slotLabelFormat: "HH:mm",
		eventClick: function (event) {
			//nascondo tooltip
			$('.tooltip').tooltip('hide');
		},
		eventResizeStart: function () {
			$('.tooltip').tooltip('hide');
		},
		eventResizeStop: function () {
			$('.tooltip').tooltip('hide');
		},
		eventDragStart: function () {
			$('.tooltip').tooltip('hide');
		},
		eventDragStop: function () {
			$('.tooltip').tooltip('hide');
		},
		eventResize: function (event) {
			//
		},
		eventDrop: function (event) {
			//
		},
		eventRender: function (eventObj, $el) {
			//
		},
		dayClick: function (date, jsEvent, view) {
			modalEvent.modal('toggle');
		},
		selectable: true,
		//@ts-ignore
		selectMinDistance: 0,
		unselectAuto: true,
		select: function (start, end) {
		
		},
		height: 500,
		fixedWeekCount: false,
		customButtons: {},
		header: {
			left: 'agendaWeek,month',
			center: 'title',
			right: 'action today prev,next'
		},
		themeSystem: 'bootstrap4',
		bootstrapFontAwesome: {
			prev: 'fa-chevron-left',
			next: 'fa-chevron-right',
			prevYear: 'fa-angle-double-left',
			nextYear: 'fa-angle-double-right'
		},
		defaultView: 'month',
		firstDay: 1,
		eventColor: '#6d5cae',
		eventTextColor: '#ffffff',
		viewRender: function () {
		}
	});
});
