@extends('ikpanel::dashboard')

@section('title')
	{{ __('ikpanel-blog::blog.articles.show.title') }}
@endsection

@section('section_name')
	{{ __('ikpanel-blog::blog.articles.show.sectionName') }}
@endsection

@section('initial_link')
	{!! css('ikpanel/assets/plugins/jquery-datatable/media/css/jquery.dataTables.css') !!}
	{!! css('ikpanel/assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css') !!}
	{!! css('ikpanel/assets/plugins/datatables-responsive/css/datatables.responsive.css') !!}
	{!! css('ikpanel/assets/plugins/select2/css/select2.css') !!}
@endsection

@section('before_body')
@endsection

@section('action_navbar')
	<div class="row action-navbar" id="action-navbar">
		<div class="col-md-12">
			<a type="button" href="{{admin_url('/mod/blog/articles/new')}}" class="btn btn-primary btn-sm">
				<i class="fas fa-plus fa-fw"></i>
				{{ __('ikpanel-blog::blog.articles.show.buttons.new') }}
			</a>
			<a type='button' class="btn btn-danger btn-sm" href="{{admin_url()}}">
				<i class="fa fa-times-circle fa-fw" aria-hidden="true"></i>
				{{ __('ikpanel-blog::blog.articles.show.buttons.close') }}
			</a>
		</div>
	</div>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-4">
			<div class="form-group form-group-default ">
				<label for="search-filter">
					{{ __('ikpanel-blog::blog.articles.show.search') }}
				</label>
				<input type="text" class="form-control" id="search-filter" autocomplete="off">
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group form-group-default form-group-default-select2">
				<label for="status-filter">
					{{ __('ikpanel-blog::blog.articles.show.filterLabel') }}
				</label>
				<select id="status-filter" class="full-width select2-hidden-accessible" tabindex="-1"
				        aria-hidden="true"
				        autocomplete="off">
					<option value="ALL">
						{{ __('ikpanel-blog::blog.articles.show.filters.all') }}
					</option>
					<option value="ACTIVE" selected>
						{{ __('ikpanel-blog::blog.articles.show.filters.active') }}
					</option>
					<option value="DELETED">
						{{ __('ikpanel-blog::blog.articles.show.filters.deleted') }}
					</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					@component('ikpanel-blog::articles.table', ['posts' => $posts])
					@endcomponent
				</div>
			</div>
		</div>
	</div>
@endsection

@section('final_script')
	{!! script('ikpanel/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js') !!}
	{!! script('ikpanel/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js') !!}
	{!! script('ikpanel/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js') !!}
	{!! script('ikpanel/assets/plugins/datatables-responsive/js/datatables.responsive.js') !!}
	{!! script('ikpanel/assets/plugins/datatables-responsive/js/lodash.min.js') !!}
	{!! script('ikpanel/assets/plugins/select2/js/select2.js') !!}
	{!! script('ikpanel/modules/blog/js/articles/show.js',true) !!}
@endsection