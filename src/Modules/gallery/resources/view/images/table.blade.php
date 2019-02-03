<table id="galleryImagesTable"
       class="table table-valign table-condensed"
       cellspacing="0"
       width="100%">
	<thead>
	<tr>
		<th class="text-center" style="width: 10px;"><i class="fas fa-sort"></i></th>
		<th>
			{{ __('ikpanel-gallery::gallery.images.show.table.name') }}
		</th>
		<th>
			{{ __('ikpanel-gallery::gallery.images.show.table.description') }}
		</th>
		<th>
			{{ __('ikpanel-gallery::gallery.images.show.table.image') }}
		</th>
		<th>
			{{ __('ikpanel-gallery::gallery.images.show.table.categories') }}
		</th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	@foreach($images as $img)
		<tr>
			<td class="text-center handle" style="padding: 0 !important;cursor: move;">
				<i class="fa fa-ellipsis-v fa-fw"></i>
			</td>
			<td>
				{{ $img->name }}
			</td>
			<td>
				{!! $img->description !!}
			</td>
			<td>
				<img class="img-fluid img-thumbnail"
				     alt="{{ $img->name }}"
				     style="width: 150px"
				     src="{{ asset($img->path) }}">
			</td>
			<td>
				@foreach($img->categories as $cat)
					@if(!$loop->last)
						<a href="{{ admin_url("/mod/blog/categories/edit/$cat->id") }}">
							{{ $cat->name }},
						</a>
					@else
						<a href="{{ admin_url("/mod/blog/categories/edit/$cat->id") }}">
							{{ $cat->name }}
						</a>
					@endif
				@endforeach
			</td>
			<td style="text-align: right">
				@if(is_null($img->deleted_at))
					<div class="btn-group" role="group" aria-label="edit-category">
						<a href="{{admin_url('/mod/gallery/images/edit/' . $img->id)}}" class="btn btn-info btn-sm">
							{{ __('ikpanel-blog::blog.articles.show.buttons.actionEdit') }}
						</a>
						<button type="button" class="btn btn-sm btn-danger action-delete" data-id="{{$img->id}}">
							{{ __('ikpanel-gallery::gallery.images.show.buttons.actionDelete') }}
						</button>
					</div>
				@else
					<button class="btn btn-success btn-sm action-restore" style="min-width: 110px;"
					        data-id="{{ $img->id }}">
						<i class="fas fa-undo-alt fa-fw"></i>
						{{ __('ikpanel-gallery::gallery.images.show.buttons.actionRestore') }}
					</button>
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
