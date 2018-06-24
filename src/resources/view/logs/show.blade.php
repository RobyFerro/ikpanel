@extends('ikpanel::dashboard')

@section('title','Logs')

@section('section_name','Logs')

@section('initial_link')
    <link type="text/css" rel="stylesheet"
          href="{{ asset('ikpanel/assets/plugins/jquery-datatable/media/css/jquery.dataTables.css') }}">
    <link type="text/css" rel="stylesheet"
          href="{{ asset('ikpanel/assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css') }}">
    <link media="screen" type="text/css" rel="stylesheet"
          href="{{ asset('ikpanel/assets/plugins/datatables-responsive/css/datatables.responsive.css') }}">
    <link media="screen" type="text/css" rel="stylesheet"
          href="{{ asset('ikpanel/assets/plugins/select2/css/select2.css') }}">
@endsection

@section('before_body')
@endsection

@section('action_navbar')
    <div class="row">
        <div class="col-md-12">
            <a type='button' class="btn btn-danger btn-cons" href="{{ admin_url() }}">
                <i class="fa fa-times-circle" aria-hidden="true"></i>
                Chiudi
            </a>
        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="form-group form-group-default ">
                <label for="search-table">Cerca</label>
                <input type="text" class="form-control" id="search-table">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group form-group-default form-group-default-select2">
                <label class="">Filtro per tipo</label>
                <select id="log-type" class="full-width select2-hidden-accessible" tabindex="-1" aria-hidden="true" autocomplete="off">
                    <option value="ALL" selected>Tutti</option>
                    <option value="INFO">Info</option>
                    <option value="SUCCESS">Dati creati</option>
                    <option value="WARNING">Dati modificati</option>
                    <option value="DANGER">Dati eliminati</option>
                    <option value="ERROR">Errori</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table id="logs" class="table table-valign table-supercondensed dataTable table-shortpadding"
                   cellspacing="0" width="100%">
                <colgroup>
                    <col style="width: 40px;">
                    <col style="width: 150px;">
                    <col style="width: 90px;">
                    {{--<col style="width: auto;">--}}
                    <col style="width: auto;">
                    <col style="width: 120px;">
                    <col style="width: 200px;">
                </colgroup>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Utente</th>
                    <th class="text-center">Tipo</th>
                    <th>tmp</th>
                    <th>Azione</th>
                    <th>IP</th>
                    <th>Data</th>
                </tr>
                </thead>
                <tbody>
                @foreach($logs as $i=>$log)
                    <tr>
                        <td class="text-center">{{ ($i+1) }}</td>
                        <td>{{ $log->user->name }} {{ $log->user->surname }}</td>
                        <td class="text-center">
                            @switch($log->type)
                                @case('INFO')
                                <span class="fa-stack" data-toggle="tooltip" title="Info" style="font-size: 10px;">
									<i class="fas fa-circle fa-stack-2x"></i>
									<i class="fas fa-info fa-stack-1x fa-inverse"></i>
								</span>
                                @break
                                @case('SUCCESS')
                                <span class="fa-stack" data-toggle="tooltip" title="Dati creati" style="font-size: 10px;">
									<i class="fas fa-circle fa-stack-2x text-success"></i>
									<i class="fas fa-save fa-stack-1x fa-inverse"></i>
								</span>
                                @break
                                @case('WARNING')
                                <span class="fa-stack" data-toggle="tooltip" title="Dati modificati" style="font-size: 10px;">
									<i class="fas fa-circle fa-stack-2x text-warning"></i>
									<i class="fas fa-pencil-alt fa-stack-1x fa-inverse"></i>
								</span>
                                @break
                                @case('DANGER')
                                <span class="fa-stack" data-toggle="tooltip" title="Dati eliminati" style="font-size: 10px;">
									<i class="fas fa-circle fa-stack-2x text-danger"></i>
									<i class="fas fa-trash-alt fa-stack-1x fa-inverse"></i>
								</span>
                                @break
                                @case('ERROR')
                                <span class="fa-stack" data-toggle="tooltip" title="Errore" style="font-size: 10px;">
									<i class="fas fa-circle fa-stack-2x" style="color: darkred;"></i>
									<i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
								</span>
                                @break
                            @endswitch
                        </td>
                        <td style="display: none">{{$log->type}}</td>
                        <td>{{ $log->action }}</td>
                        <td>{{ $log->ip }}</td>
                        <td>{{ $log->date }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
    <script type="text/javascript" src="{{ asset('ikpanel/assets/plugins/select2/js/select2.js') }}"></script>
    <script src="{{ asset('ikpanel/plugins/js/logs.js') }}" type="text/javascript"></script>
@endsection