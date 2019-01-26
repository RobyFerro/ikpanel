@extends('ikpanel::dashboard')

@section('title')
	{{ __('ikpanel-blog::blog.articles.new.title') }}
@endsection

@section('section_name')
	{{ __('ikpanel-blog::blog.articles.new.sectionName') }}
@endsection

@section('initial_link')
	{!! css('ikpanel/assets/plugins/select2/css/select2.css') !!}
@endsection

@section('before_body')
@endsection

@section('action_navbar')
	@component('ikpanel::components.action_buttons', ['save_new'=>false,'close' => admin_url('/mod/blog/articles/show')])
	@endcomponent
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="form-group form-group-default required">
				<label for="title">
					{{ __('ikpanel-blog::blog.articles.new.inputs.title') }}
				</label>
				<input class="form-control form-data" id="title" value="" autocomplete="off">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title">
								{{ __('ikpanel-blog::blog.articles.edit.inputs.content') }}
							</div>
						</div>
						<div class="card-body">
							<textarea id="content" class="form-data"
							          autocomplete="off"></textarea>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title">
								{{ __('ikpanel-blog::blog.articles.edit.inputs.shortDescription') }}
							</div>
						</div>
						<div class="card-body">
							<textarea id="shortDescription" class="form-data"
							          autocomplete="off"></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						{{ __('ikpanel-blog::blog.articles.new.inputs.keywords') }}
					</div>
				</div>
				<div class="card-body">
					<textarea id="keywords"
					          rows="50"
					          style="min-height: 200px"
					          autocomplete="off"
					          class="form-control form-data"></textarea>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						{{ __('ikpanel-blog::blog.articles.new.inputs.categories') }}
					</div>
				</div>
				<div class="card-body">
					@foreach($categories as $cat)
						<div class="checkbox check-default">
							<input type="checkbox"
							       class="form-data"
							       autocomplete="off"
							       value="1"
							       id="category-{{ $cat->id }}">
							<label for="category-{{ $cat->id }}">
								{{ $cat->name }}
							</label>
						</div>
					@endforeach
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						{{ __('ikpanel-blog::blog.articles.edit.inputs.ownerLabel') }}
					</div>
				</div>
				<div class="card-body">
					<div class="form-group form-group-default required">
						<label for="title">
							{{ __('ikpanel-blog::blog.articles.new.inputs.ownerAlias') }}
						</label>
						<input class="form-control form-data"
						       id="ownerAlias"
						       value=""
						       autocomplete="off">
					</div>
					<div class="form-group form-group-default form-group-default-select2">
						<label for="author">
							{{ __('ikpanel-blog::blog.articles.new.inputs.authorList') }}
						</label>
						<select id="author" class="full-width select2-hidden-accessible form-data" tabindex="-1"
						        aria-hidden="true"
						        autocomplete="off">
							@foreach($users as $user)
								@if(\Illuminate\Support\Facades\Auth::id() == $user->id)
									<option value="{{ $user->id }}" selected>
										{{ $user->name }} {{ $user->surname }}
									</option>
								@else
									<option value="{{ $user->id }}">
										{{ $user->name }} {{ $user->surname }}
									</option>
								@endif
							@endforeach
						</select>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						{{ __('ikpanel-blog::blog.articles.new.inputs.mainPic') }}
					</div>
				</div>
				<div class="card-body">
					<div class="form-group form-group-default">
						<input class="form-control form-data"
						       type="file"
						       id="main-pic"
						       value=""
						       autocomplete="off">
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('final_script')
	{!! script('ikpanel/assets/plugins/ckeditor/ckeditor.js') !!}
	{!! script('ikpanel/assets/plugins/ckeditor/adapters/jquery.js') !!}
	{!! script('ikpanel/assets/plugins/select2/js/select2.js') !!}
	{!! script('ikpanel/modules/blog/js/articles/new.js',true) !!}
@endsection
