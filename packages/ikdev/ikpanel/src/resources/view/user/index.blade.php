@extends('ikpanel::dashboard')

@section('title','Gestione utenti')

@section('section_name','Gestione utenti')

@section('initial_link')
    <link type="text/css" rel="stylesheet"
          href="{{ asset('ikpanel/assets/plugins/jquery-datatable/media/css/jquery.dataTables.css') }}">
    <link type="text/css" rel="stylesheet"
          href="{{ asset('ikpanel/assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css') }}">
    <link media="screen" type="text/css" rel="stylesheet"
          href="{{ asset('ikpanel/assets/plugins/datatables-responsive/css/datatables.responsive.css') }}">
@endsection

@section('before_body')
@endsection

@section('action_navbar')
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#new_user">
                <i class="fas fa-user-plus"></i>
                Nuovo utente
            </button>
            <a type="button" class="btn btn-danger btn-sm" href="/">
                <i class="fa fa-times-circle"></i>
                Chiudi
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <input type="text" id="search-table" class="form-control pull-right" placeholder="Search">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-condensed dataTable" cellspacing="0" width="100%" id="main_table">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>E-mail</th>
                    <th>Azione</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="v-align-middle ">
                            <p>{{ $user->name }}</p>
                        </td>
                        <td class="v-align-middle ">
                            <p>{{ $user->surname }}</p>
                        </td>
                        <td class="v-align-middle ">
                            <p>{{ $user->email }}</p>
                        </td>
                        <td class="v-align-middle" style="text-align: right">
                            <a type="button" href="{{ env('IKPANEL_URL') }}/users/edit/{{$user->id}}" class="btn btn-success btn-sm">
                                <i class="fas fa-edit"></i>
                                Modifica
                            </a>
                            <button type="button" data-user="{{ $user->id }}" class="btn btn-danger btn-sm delete">
                                <i class="fas fa-trash-alt"></i>
                                Elimina
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL NUOVO UTENTE --}}
    <div class="modal fade slide-up" id="new_user" tabindex="-1" role="dialog" aria-labelledby="NuovoUtente" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header clearfix text-left">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="pg-close fs-14"></i>
                    </button>
                    <h3>Inserisci nuovo <span class="semi-bold">utente</span></h3>
                    <p>Compila il form sottostante per inserire un un nuovo utente</p>
                </div>
                <div class="modal-body">
                    <form class="form-default" role="form">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>E-Mail</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" class="form-control" id="name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Cognome</label>
                                    <input type="text" class="form-control" id="surname">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" id="password-1">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Ripeti password</label>
                                    <input type="password" class="form-control" id="password-2">
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-primary btn-lg btn-large btn-block" id="save">
                                <i class="fal fa-save"></i>
                                Inserisci nuovo utente
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- MODAL NUOVO UTENTE --}}
@endsection

@section('final_script')
    <script type="text/javascript" src="{{ asset('ikpanel/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('ikpanel/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('ikpanel/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js') }}"></script>
    <script src="{{ asset('ikpanel/assets/plugins/datatables-responsive/js/datatables.responsive.js') }}" type="text/javascript"></script>
    <script src="{{ asset('ikpanel/assets/plugins/datatables-responsive/js/lodash.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('ikpanel/plugins/js/users.js') }}" type="text/javascript"></script>
@endsection