@extends('ikpanel::dashboard')

@section('title','Gestione media')

@section('section_name','Gestione media')

@section('initial_link')
@endsection

@section('before_body')
@endsection

@section('action_navbar')
@endsection

@section('content')
    <iframe src="/laravel-filemanager" style="width: 100%; height: 600px; overflow: hidden; border: none;"></iframe>
@endsection

@section('final_script')
@endsection