@extends('ikpanel::dashboard')

@section('title')
	{{ __('ikpanel-blog::blog.categories.show.title') }}
@endsection

@section('section_name')
	{{ __('ikpanel-blog::blog.categories.show.sectionName') }}
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
			<table id="candidacy-step-table" class="table table-valign table-condensed" cellspacing="0" width="100%">
				<thead>
				<tr>
					<th class="text-center" style="width: 10px;"><i class="fas fa-sort"></i></th>
				</tr>
				</thead>
				<tbody>
				<tr></tr>
				</tbody>
			</table>
		</div>
	</div>
@endsection

@section('final_script')
	<script src="{{ asset('ikpanel/modules/blog/js/categories/show.js') }}"></script>
@endsection