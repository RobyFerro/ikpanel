<table id="blogPostsTable"
       class="table table-valign table-condensed"
       cellspacing="0"
       width="100%">
	<thead>
	<tr>
		<th class="text-center" style="width: 10px;"><i class="fas fa-sort"></i></th>
		<th>
			{{ __('ikpanel-blog::blog.articles.show.table.title') }}
		</th>
		<th>
			{{ __('ikpanel-blog::blog.articles.show.table.description') }}
		</th>
		<th>
			{{ __('ikpanel-blog::blog.articles.show.table.publishDate') }}
		</th>
		<th>
			{{ __('ikpanel-blog::blog.articles.show.table.categories') }}
		</th>
		<th>
			{{ __('ikpanel-blog::blog.articles.show.table.author') }}
		</th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	@foreach($posts as $post)
		<tr>
			<td class="text-center handle" style="padding: 0 !important;cursor: move;">
				<i class="fa fa-ellipsis-v fa-fw"></i>
			</td>
			<td>
				{{ $post->title }}
			</td>
			<td>
				{{ $post->title }}
			</td>
			<td>
				{{ $post->created_at->format('d/m/y H:i:s') }}
			</td>
			<td>
				@foreach($post->categories as $cat)
					@if(!$loop->last)
						@can('blog-categories.view')
							<a href="{{ admin_url("/mod/blog/categories/edit/$cat->id") }}">
								{{ $cat->name }},
							</a>
						@else
							{{ $cat->name }},
						@endcan
					@else
						@can('blog-categories.view')
							<a href="{{ admin_url("/mod/blog/categories/edit/$cat->id") }}">
								{{ $cat->name }},
							</a>
						@else
							{{ $cat->name }},
						@endcan
					@endif
				@endforeach
			</td>
			<td>
				{{ $post->owner_alias }}
			</td>
			<td style="text-align: right">
				@if(is_null($post->deleted_at))
					<div class="btn-group" role="group" aria-label="edit-category">
						@can('blog-articles.update')
							<a href="{{admin_url('/mod/blog/articles/edit/' . $post->id)}}" class="btn btn-info btn-sm">
								{{ __('ikpanel-blog::blog.articles.show.buttons.actionEdit') }}
							</a>
						@endcan
						@can('blog-articles.delete')
							<button type="button" class="btn btn-sm btn-danger action-delete" data-id="{{$post->id}}">
								{{ __('ikpanel-blog::blog.articles.show.buttons.actionDelete') }}
							</button>
						@endcan
					</div>
				@else
					@can('blog-articles.restore')
						<button class="btn btn-success btn-sm action-restore" style="min-width: 110px;"
						        data-id="{{ $post->id }}">
							<i class="fas fa-undo-alt fa-fw"></i>
							{{ __('ikpanel-blog::blog.articles.show.buttons.actionRestore') }}
						</button>
					@endcan
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
