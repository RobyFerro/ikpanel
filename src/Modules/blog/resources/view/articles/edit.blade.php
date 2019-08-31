@extends('ikpanel::dashboard')

@section('title')
    {{ __('ikpanel-blog::blog.articles.edit.title') }} - {{ $post->title }}
@endsection

@section('section_name')
    {{ __('ikpanel-blog::blog.articles.edit.sectionName') }} - {{ $post->title }}
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
    <input type="hidden" id="articleID" class="form-data" value="{{ $post->id }}">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group form-group-default required">
                <label for="title">
                    {{ __('ikpanel-blog::blog.articles.edit.inputs.title') }}
                </label>
                <input class="form-control form-data" id="title" value="{{ $post->title }}" autocomplete="off">
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
                                      autocomplete="off">{{ $post->content }}</textarea>
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
                                      autocomplete="off">{{ $post->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('ikpanel-blog::blog.articles.edit.inputs.keywords') }}
                    </div>
                </div>
                <div class="card-body">
					<textarea id="keywords"
                              rows="50"
                              style="min-height: 200px"
                              autocomplete="off"
                              class="form-control form-data">{{ $post->keywords }}</textarea>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('ikpanel-blog::blog.articles.edit.inputs.categories') }}
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
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('ikpanel-blog::blog.articles.edit.inputs.ownerLabel') }}
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group form-group-default required">
                        <label for="title">
                            {{ __('ikpanel-blog::blog.articles.edit.inputs.ownerAlias') }}
                        </label>
                        <input class="form-control form-data"
                               id="ownerAlias"
                               value="{{ $post->owner_alias }}"
                               autocomplete="off">
                    </div>
                    <div class="form-group form-group-default form-group-default-select2">
                        <label for="author">
                            {{ __('ikpanel-blog::blog.articles.edit.inputs.authorList') }}
                        </label>
                        <select id="author" class="full-width select2-hidden-accessible form-data" tabindex="-1"
                                aria-hidden="true"
                                autocomplete="off">
                            @foreach($users as $user)
                                @if($post->id_owner == $user->id)
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
                        <img
                                @if(is_null($post->main_pic))
                                src="{{ asset('ikpanel/assets/modules/blog/img/no-image.jpg') }}"
                                @else
                                src="{{ asset($post->main_pic) }}"
                                @endif
                                id="main-pic-preview"
                                class="img-fluid img-thumbnail"
                                alt="Main image">
                        <hr>
                        <input class="form-control form-data"
                               type="file"
                               accept="image/*"
                               id="main-pic"
                               value=""
                               autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-block btn-danger" id="deleteArticles" data-id="{{ $post->id }}">
                        <i class="fas fa-trash-alt"></i>
                        {{ __('ikpanel-blog::blog.articles.edit.buttons.delete') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('final_script')
    {!! script('ikpanel/assets/plugins/ckeditor/ckeditor.js') !!}
    {!! script('ikpanel/assets/plugins/ckeditor/adapters/jquery.js') !!}
    {!! script('ikpanel/assets/plugins/select2/js/select2.js') !!}
    {!! script('ikpanel/modules/blog/js/articles/edit.js',true) !!}
@endsection
