@extends('ikpanel::dashboard')

@section('title','Home')

@section('section_name','Home')

@section('initial_link')
@endsection

@section('before_body')
@endsection

@section('action_navbar')
@endsection

@section('content')
	{{--<div class="text-center">
		<img style="width: 800px;" src="{{asset('/ikpanel/assets/img/')}}"/>
	</div>--}}
@endsection

@section('final_script')
	<script type="text/javascript"
	        src="{{ asset('ikpanel/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript"
	        src="{{ asset('ikpanel/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
	<script type="text/javascript"
	        src="{{ asset('ikpanel/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js') }}"></script>
	<script type="text/javascript"
	        src="{{ asset('ikpanel/assets/plugins/datatables-responsive/js/datatables.responsive.js') }}"></script>
	<script type="text/javascript" src="{{ asset('ikpanel/plugins/js/widgets/widgets.js') }}"></script>
@endsection
