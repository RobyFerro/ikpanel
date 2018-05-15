@extends('ikpanel::dashboard')

@section('title','Modifica utente')

@section('section_name','Modifica utente')

@section('initial_link')

@endsection

@section('before_body')
@endsection

@section('action_navbar')
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-success btn-sm" id="save" data-user="{{ $user->id }}">
                <i class="fas fa-user-plus"></i>
                Salva
            </button>
            <button class="btn btn-warning btn-sm" data-user="{{ $user->id }}" id="delete">
                <i class="fas fa-user-times"></i>
                Rimuovi utente
            </button>
            <a type="button" class="btn btn-danger btn-sm" href="{{ url(env('IKPANEL_URL').''.'/users') }}">
                <i class="fas fa-arrow-alt-circle-left"></i>
                Indietro
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input class="form-control" id="name" type="text" value="{{ $user->name }}">
            </div>
            <div class="form-group">
                <label for="surname">Cognome:</label>
                <input class="form-control" id="surname" type="text" value="{{ $user->surname }}">
            </div>
            <div class="form-group">
                <label for="mail">Indirizzo mail:</label>
                <input class="form-control" id="mail" type="email" placeholder="{{ $user->email }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="password">Nuova password:</label>
                <input class="form-control" id="password" type="password">
            </div>
            <div class="form-group">
                <label for="password_1">Ripeti password</label>
                <input class="form-control" id="password_1" type="password">
            </div>
        </div>
        <div class="col-md-4" style="text-align: right">

        </div>
    </div>
@endsection

@section('final_script')
    <script type="text/javascript"
            src="{{ asset('ikpanel/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('ikpanel/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('ikpanel/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js') }}"></script>
    <script src="{{ asset('ikpanel/assets/plugins/datatables-responsive/js/datatables.responsive.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('ikpanel/assets/plugins/datatables-responsive/js/lodash.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('ikpanel/plugins/js/user_edit.js') }}" type="text/javascript"></script>
@endsection