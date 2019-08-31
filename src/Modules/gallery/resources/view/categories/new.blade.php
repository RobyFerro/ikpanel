@extends('ikpanel::dashboard')

@section('title')
    {{ __('ikpanel-gallery::gallery.categories.new.title') }}
@endsection

@section('section_name')
    {{ __('ikpanel-gallery::gallery.categories.new.sectionName') }}
@endsection

@section('initial_link')

@endsection

@section('before_body')
@endsection

@section('action_navbar')
    @component('ikpanel::components.action_buttons', ['save_new'=>false,'close' => admin_url('/mod/gallery/categories/show')])
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group form-group-default required">
                <label for="name">
                    {{ __('ikpanel-gallery::gallery.categories.new.inputs.categoryName') }}
                </label>
                <input class="form-control form-data" id="name" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('ikpanel-gallery::gallery.categories.new.inputs.categoryDescription') }}
                    </div>
                </div>
                <div class="card-body">
					<textarea id="categoryDescription" class="form-data"
                              autocomplete="off"></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('ikpanel-gallery::gallery.categories.new.inputs.keywordsDescription') }}
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
        </div>
    </div>
@endsection

@section('final_script')
    {!! script('ikpanel/assets/plugins/ckeditor/ckeditor.js') !!}
    {!! script('ikpanel/assets/plugins/ckeditor/adapters/jquery.js') !!}
    {!! script('ikpanel/modules/gallery/js/category/new.js',true) !!}
@endsection
