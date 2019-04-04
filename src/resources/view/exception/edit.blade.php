@extends('ikpanel::dashboard')

@section('title')
	{{ __('ikpanel::exceptions.edit.title') }}
@endsection

@section('section_name')
	{{ __('ikpanel::exceptions.edit.section-name') }}
@endsection

@section('initial_link')
@endsection

@section('before_body')
@endsection

@section('action_navbar')
@endsection

@section('content')
	<input type="hidden" data-id="{{$exception->id}}" id="exceptionID">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-4">
							<h4>
								<strong>
									{{ __('ikpanel::exceptions.edit.ip_address') }}
								</strong>
								{{ $exception->ip }}
							</h4>
						</div>
						<div class="col-md-4">
							<h4>
								<strong>
									{{ __('ikpanel::exceptions.edit.reported_at') }}
								</strong>
								{{ $exception->created_at }}
							</h4>
						</div>
						<div class="col-md-4">
							<h4>
								<strong>
									{{ __('ikpanel::exceptions.edit.exception_type') }}
								</strong>
								<span class="badge badge-pill badge-success">
									Back end
								</span>
							</h4>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<strong>
								{{ __('ikpanel::exceptions.edit.user_agent') }}
							</strong>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							{{ optional($exception->user_agent)->browser->toString() }}
						</div>
						<div class="col-md-4">
							{{ optional($exception->user_agent)->os->toString() }}
						</div>
						<div class="col-md-4">
							@if(!empty($exception->user_agent->device->toString()))
								{{ optional($exception->user_agent)->device->toString() }}
							@else
								{{__('ikpanel::exceptions.edit.unknown_device')}}
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="card-title"></div>
				</div>
				<div class="card-body">
					@forelse($exception->exception as $stack)
						{!! $stack !!}
					@empty
						<h2>
							{{ __('ikpanel::exceptions.edit.no_stack_found') }}
						</h2>
					@endforelse
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<h5>
								<strong>{{ __('ikpanel::exceptions.edit.first_seen') }}</strong>
								{{ $exception->first_seen}}
							</h5>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h5>
								<strong>{{ __('ikpanel::exceptions.edit.last_seen') }}</strong>
								{{ $exception->last_seen}}
							</h5>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h5>
								<strong>{{ __('ikpanel::exceptions.edit.fixed_at') }}</strong>
								<span id="fixed_at">
									@if(empty($exception->fixed_at))
										N/A
									@else
										{{ $exception->fixed_at}}
									@endif
								</span>
							</h5>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<hr>
						</div>
					</div>
					@if(empty($exception->deleted_at))
						@if(empty($exception->fixed_at))
							<div class="row">
								<div class="col-md-12">
									<button class="btn btn-animated btn-complete btn-block mb-1" id="resolve">
										{{ __('ikpanel::exceptions.edit.buttons.resolve') }}
									</button>
								</div>
							</div>
						@endif
						@can('exceptions.delete')
							<div class="row">
								<div class="col-md-12">
									<button class="btn btn-animated btn-danger btn-block" id="delete">
										{{ __('ikpanel::exceptions.edit.buttons.delete') }}
									</button>
								</div>
							</div>
						@endcan
					@else
						@can('exceptions.restore')
							<div class="row">
								<div class="col-md-12">
									<button class="btn btn-animated btn-success btn-block" id="restore">
										{{ __('ikpanel::exceptions.edit.buttons.restore') }}
									</button>
								</div>
							</div>
						@endcan
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection

@section('final_script')
	<script src="{{asset('ikpanel/plugins/js/exceptions/edit.js')}}"></script>
@endsection
