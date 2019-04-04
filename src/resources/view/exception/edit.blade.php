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
						<div class="col-md-4 text-center">
							<h4>
								<strong>
									{{ __('ikpanel::exceptions.edit.ip_address') }}
								</strong>
								{{ $exception->ip }}
							</h4>
						</div>
						<div class="col-md-4 text-center">
							<h4>
								<strong>
									{{ __('ikpanel::exceptions.edit.reported_at') }}
								</strong>
								{{ $exception->created_at }}
							</h4>
						</div>
						<div class="col-md-4 text-center">
							<h4>
								<strong>
									{{ __('ikpanel::exceptions.edit.exception_type') }}
								</strong>
								@switch($exception->type)
									@case('back')
									Back end
									@break
									@case('front')
									Front end
									@break
								@endswitch
							
							</h4>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<hr>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-12 text-center">
									@if($exception->user_agent)
										@switch($exception->user_agent->browser->name)
											@case('Chrome')
											<img class="img img-fluid rounded" style="max-width: 100px"
											     src="{{asset('ikpanel/assets/img/icons/chrome.png')}}" alt="chrome">
											@break;
											@case('Firefox')
											<img class="img img-fluid rounded" style="max-width: 100px"
											     src="{{asset('ikpanel/assets/img/icons/firefox.png')}}" alt="firefox">
											@break;
											@case('Safari')
											<img class="img img-fluid rounded" style="max-width: 100px"
											     src="{{asset('ikpanel/assets/img/icons/safari.png')}}" alt="safari">
											@break;
											@case('Internet Explorer')
											<img class="img img-fluid rounded" style="max-width: 100px"
											     src="{{asset('ikpanel/assets/img/icons/explorer.png')}}"
											     alt="explorer">
											@break;
											@case('Edge')
											<img class="img img-fluid rounded" style="max-width: 100px"
											     src="{{asset('ikpanel/assets/img/icons/edge.png')}}" alt="edge">
											@default
											<img class="img img-fluid rounded" style="max-width: 100px"
											     src="{{asset('ikpanel/assets/img/icons/unknown.png')}}" alt="unknown">
											@break;
											@break;
										@endswitch
									@endif
								</div>
								<div class="col-md-12 text-center">
									<h4>{{ optional($exception->user_agent)->browser->toString() }}</h4>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-12 text-center">
									@if($exception->user_agent)
										@if($exception->user_agent->isOs('Windows'))
											<img class="img img-fluid rounded" style="max-width: 100px"
											     src="{{asset('ikpanel/assets/img/icons/win-8.png')}}" alt="windows">
										@elseif($exception->user_agent->isOs('OS X') || $exception->user_agent->isOs('iOS'))
											<img class="img img-fluid rounded" style="max-width: 100px"
											     src="{{asset('ikpanel/assets/img/icons/apple.png')}}" alt="apple">
										@elseif($exception->user_agent->isOs('Android'))
											<img class="img img-fluid rounded" style="max-width: 100px"
											     src="{{asset('ikpanel/assets/img/icons/android.png')}}" alt="android">
										@endif
									@endif
								</div>
								<div class="col-md-12 text-center">
									<h4>{{ optional($exception->user_agent)->os->toString() }}</h4>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-12 text-center">
									@if(!is_null($exception->user_agent->device))
										@switch($exception->user_agent->device->type)
											@case('desktop')
											<img class="img img-fluid rounded" style="max-width: 100px"
											     src="{{asset('ikpanel/assets/img/icons/desktop.png')}}" alt="desktop">
											@break;
											@case('mobile')
											<img class="img img-fluid rounded" style="max-width: 100px"
											     src="{{asset('ikpanel/assets/img/icons/mobile.png')}}" alt="mobile">
											@break
											@case('tablet')
											<img class="img img-fluid rounded" style="max-width: 100px"
											     src="{{asset('ikpanel/assets/img/icons/tablet.png')}}" alt="tablet">
											@break
										@endswitch
									@else
										<img class="img img-fluid rounded" style="max-width: 100px"
										     src="{{asset('ikpanel/assets/img/icons/unknown.png')}}" alt="unknown">
									@endif
								</div>
								<div class="col-md-12 text-center">
									@if(!empty($exception->user_agent->device->toString()))
										<h4>{{ optional($exception->user_agent)->device->toString() }}</h4>
									@else
										<h4>{{ucfirst($exception->user_agent->device->type)}}
											: {{__('ikpanel::exceptions.edit.unknown_device')}}</h4>
									@endif
								</div>
							</div>
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
