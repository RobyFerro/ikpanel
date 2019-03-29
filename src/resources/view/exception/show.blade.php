@extends('ikpanel::dashboard')

@section('title')
	{{ __('ikpanel::exceptions.show.title') }}
@endsection

@section('section_name')
	{{ __('ikpanel::exceptions.show.section-name') }}
@endsection

@section('initial_link')
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
					<table class="table table-bordered table-condensed">
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
									<a href="#" style="font-size: medium">
										{{ str_limit($error->exception,100) }}
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
								<td colspan="3">
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
	<div class="row">
		<div class="col-md-12">
			{{ $exceptions->links() }}
		</div>
	</div>
@endsection

@section('final_script')
@endsection
