@extends('ikpanel::dashboard')

@section('title')
	{{ __('ikpanel-blog::blog.categories.edit.title') }} - {{ $category->name }}
@endsection

@section('section_name')
	{{ __('ikpanel-blog::blog.categories.edit.sectionName') }} - {{ $category->name }}
@endsection

@section('initial_link')

@endsection

@section('before_body')
@endsection

@section('action_navbar')
	@component('ikpanel::components.action_buttons', ['save_new'=>false,'close' => admin_url('/users/')])
	@endcomponent
@endsection

@section('content')
	<input type="hidden" id="categoryID" class="form-data" value="{{ $category->id }}">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group form-group-default required">
				<label for="name">
					{{ __('ikpanel-blog::blog.categories.edit.inputs.categoryName') }}
				</label>
				<input class="form-control form-data" id="name" value="{{ $category->name }}">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						{{ __('ikpanel-blog::blog.categories.edit.inputs.categoryDescription') }}
					</div>
				</div>
				<div class="card-body">
					<textarea id="categoryDescription" class="form-data"
					          autocomplete="off">{{ $category->description }}</textarea>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						{{ __('ikpanel-blog::blog.categories.edit.inputs.keywordsDescription') }}
					</div>
				</div>
				<div class="card-body">
					<textarea id="keywords"
					          rows="50"
					          style="min-height: 200px"
					          autocomplete="off"
					          class="form-control form-data">{{ $category->keywords }}</textarea>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<button class="btn btn-block btn-danger" id="deleteCategory" data-id="{{ $category->id }}">
						<i class="fas fa-trash-alt"></i>
						{{ __('ikpanel-blog::blog.categories.edit.buttons.delete') }}
					</button>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('final_script')
	{!! script('ikpanel/assets/plugins/ckeditor/ckeditor.js') !!}
	{!! script('ikpanel/assets/plugins/ckeditor/adapters/jquery.js') !!}
	{!! script('ikpanel/modules/blog/js/category/edit.js',true) !!}
@endsection