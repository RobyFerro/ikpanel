@extends('ikpanel::dashboard')

@section('title')
    {{ __('ikpanel-calendar::calendar.show.titleName') }}
@endsection

@section('section_name')
    {{ __('ikpanel-calendar::calendar.show.sectionName') }}
@endsection

@section('initial_link')
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

@endpush

@section('final_script')
    {!! script('ikpanel/modules/calendar/js/index.js',true) !!}
@endsection
