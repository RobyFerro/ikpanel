@extends('ikpanel::dashboard')

@section('title')
    {{ __('ikpanel-gallery::gallery.images.edit.title') }}
@endsection

@section('section_name')
    {{ __('ikpanel-gallery::gallery.images.edit.sectionName') }}
@endsection

@section('initial_link')
@endsection

@section('before_body')
@endsection

@section('action_navbar')
    @component('ikpanel::components.action_buttons', ['save_new'=>false,'close' => admin_url('/mod/gallery/images/show')])
    @endcomponent
@endsection

@section('content')
    <input type="hidden" id="imageID" class="form-data" value="{{ $img->id }}">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group form-group-default required">
                <label for="title">
                    {{ __('ikpanel-gallery::gallery.images.edit.inputs.title') }}
                </label>
                <input class="form-control form-data" id="title" value="{{ $img->name }}" autocomplete="off">
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
                                {{ __('ikpanel-gallery::gallery.images.edit.inputs.pic') }}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    @if(is_null($img->path))
                                        <img src="{{ asset('ikpanel/modules/gallery/img/no-image-full.png') }}"
                                             id="pic-preview"
                                             class="img-fluid"
                                             style="width: 100%"
                                             alt="Main image">
                                    @else
                                        <img src="{{ asset($img->path) }}"
                                             id="pic-preview"
                                             style="width: 100%"
                                             alt="{{ $img->name }}"
                                             class="img-fluid">
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="file"
                                           id="pic"
                                           class="form-control-file form-data"
                                           accept="image/png, image/jpeg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                {{ __('ikpanel-gallery::gallery.images.edit.inputs.description') }}
                            </div>
                        </div>
                        <div class="card-body">
							<textarea id="content" class="form-data"
                                      autocomplete="off">{{$img->description}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('ikpanel-gallery::gallery.images.edit.inputs.keywords') }}
                    </div>
                </div>
                <div class="card-body">
					<textarea id="keywords"
                              rows="50"
                              style="min-height: 200px"
                              autocomplete="off"
                              class="form-control form-data">{{$img->keywords}}</textarea>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('ikpanel-gallery::gallery.images.edit.inputs.categories') }}
                    </div>
                </div>
                <div class="card-body">
                    @foreach($categories as $cat)
                        <div class="checkbox check-default">
                            <input type="checkbox"
                                   class="form-data"
                                   autocomplete="off"
                                   @if(in_array($cat->id, $activeCategories))
                                   checked="checked"
                                   @endif
                                   value="1"
                                   id="category-{{ $cat->id }}">
                            <label for="category-{{ $cat->id }}">
                                {{ $cat->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('final_script')
    {!! script('ikpanel/assets/plugins/ckeditor/ckeditor.js') !!}
    {!! script('ikpanel/assets/plugins/ckeditor/adapters/jquery.js') !!}
    {!! script('ikpanel/modules/gallery/js/images/edit.js',true) !!}
@endsection
