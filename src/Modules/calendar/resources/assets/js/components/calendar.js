"use strict";
/*
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */
Object.defineProperty(exports, "__esModule", { value: true });
require("fullcalendar");
$(function () {
    var calendarContainer = $('#calendar'), modalEvent = $('#event'), eventContent = $('#eventContent');
    eventContent.ckeditor(function () {
    }, {
        language: 'it',
        height: 500
    });
    $('.input-daterange input').each(function () {
        $(this).datepicker({
            language: 'it',
            autoclose: true,
            orientation: "auto",
            weekStart: 1,
            todayBtn: true,
            todayHighlight: true,
            container: '#event'
        });
    });
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
