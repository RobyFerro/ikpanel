@extends('ikpanel::dashboard')

@section('title')
	{{ __('ikpanel::exceptions.show.title') }}
@endsection

@section('section_name')
	{{ __('ikpanel::exceptions.show.section-name') }}
@endsection

@section('initial_link')
	<link media="screen" type="text/css" rel="stylesheet"
	      href="{{ asset('ikpanel/assets/plugins/select2/css/select2.css') }}">
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
						{{ __('ikpanel::exceptions.show.card_title') }}
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group form-group-default form-group-default-select2 required">
								<label for="statusFilter">
									{{ __('ikpanel::exceptions.show.status_filter.label') }}
								</label>
								<select id="statusFilter"
								        class="full-width select2-hidden-accessible form-data"
								        tabindex="-1"
								        aria-hidden="true"
								        autocomplete="off">
									<option value="resolved">
										{{ __('ikpanel::exceptions.show.status_filter.options.resolved') }}
									</option>
									<option value="active">
										{{ __('ikpanel::exceptions.show.status_filter.options.active') }}
									</option>
									<option value="all">
										{{ __('ikpanel::exceptions.show.status_filter.options.all') }}
									</option>
									<option value="deleted">
										{{ __('ikpanel::exceptions.show.status_filter.options.deleted') }}
									</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered table-condensed" id="errorsTable">
								<colgroup>
									<col style="width: auto">
									<col style="width: 250px">
									<col style="width: 250px">
									<col style="width: 150px">
								</colgroup>
								<thead>
								<tr>
									<th>{{ __('ikpanel::exceptions.show.table.exception') }}</th>
									<th>{{ __('ikpanel::exceptions.show.table.ip_address') }}</th>
									<th>{{ __('ikpanel::exceptions.show.table.created_date') }}</th>
									<th>{{ __('ikpanel::exceptions.show.table.type') }}</th>
								</tr>
								</thead>
								<tbody>
								@forelse($exceptions as $error)
									<tr>
										<td>
											<a href="{{admin_url('/exceptions/edit/'.$error->id)}}"
											   style="font-size: medium">
												{{ str_limit(json_encode($error->exception),100) }}
											</a>
										</td>
										<td>{{ $error->ip }}</td>
										<td>{{ $error->created_at->format('d/m/Y H:i:s') }}</td>
										<td>
											@switch($error->type)
												@case('back')
												<span class="badge badge-pill badge-success">
													Back end
												</span>
												@break;
												@case('front')
												<span class="badge badge-pill badge-primary">
													Front end
												</span>
												@break
											@endswitch
										</td>
									</tr>
								@empty
									<tr>
										<td colspan="4">
											<h4>{{ __('ikpanel::exceptions.show.table.no_rows') }}</h4>
										</td>
									</tr>
								@endforelse
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			{{ $exceptions->appends(['sort' => 'votes'])->links() }}
		</div>
	</div>
@endsection

@section('final_script')
	<script type="text/javascript" src="{{ asset('ikpanel/assets/plugins/select2/js/select2.js') }}"></script>
	<script src="{{asset('ikpanel/plugins/js/exceptions/show.js')}}"></script>
@endsection
