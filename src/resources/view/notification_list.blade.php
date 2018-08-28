@extends('ikpanel::dashboard')

@section('title','Le mie notifiche')

@section('section_name','Le mie notifiche')

@section('initial_link')
@endsection

@section('before_body')
@endsection

@section('action_navbar')

@endsection

@section('content')
	<ul class="list-unstyled">
		@foreach($notifications as $item)
			<li class="media">
				<img class="mr-3" style="max-width: 50px" src="{{ asset($item->data['img']) }}"
				     alt="Generic placeholder image">
				<div class="media-body">
					<a href="{!! admin_url($item->data['link']) !!}?notification={!! $item->id  !!}">
						<h5 class="mt-0 mb-1">{!! $item->data['title'] !!}</h5>
					</a>
					{!! $item->data['message'] !!}
					<span class="pull-right">
						@if(!is_null($item->read_at))
							<i class="far fa-book-open"></i>
							{{ $item->read_at->format('d/m/Y H:i:s') }}
						@endif
					</span>
				</div>
			</li>
			<hr>
		@endforeach
	</ul>
	{{ $notifications->links('ikpanel::vendor.pagination.default') }}
@endsection

@section('final_script')

@endsection