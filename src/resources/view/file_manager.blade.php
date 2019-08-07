@extends('ikpanel::dashboard')

@section('title','File manager')

@section('section_name','File manager')

@section('initial_link')
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endsection

@section('before_body')
@endsection

@section('action_navbar')
@endsection

@section('content')
    <div style="height: 600px;">
        <div id="fm"></div>
    </div>
@endsection

@section('final_script')
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
@endsection