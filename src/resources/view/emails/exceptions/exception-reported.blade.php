@extends('ikpanel::emails.master')

@section('content')
    <table id="notification" style="table-layout: fixed" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
        <tr>
            <h1>New alert from {{ \Illuminate\Support\Facades\Config::get('app.name') }}</h1>
            <hr>
        </tr>
        <tr>
            {!! print_r($error->exception) !!}
        </tr>
        </tbody>
    </table>
@endsection
