import FormDataBag from "@ikpanel/form-data-bag";
import ModernGui from "@ikpanel/modern-gui";
import FormUtils from "@ikpanel/form_utils";

declare let admin_panel_url: string;

$(function () {
	
	let body = $('body');
	
	$('#content').ckeditor(function () {
	}, {
		language: 'it',
		height: 500
	});
	
	$('#shortDescription').ckeditor(function () {
	}, {
		language: 'it',
		height: 150
	});
	
	$('#author').select2();
	
	body.on('click', '.action-save', function () {
		let action = $(this).data('action');/*,
			file: FileList = ($('#main-pic')[0] as HTMLInputElement).files,
			formData: FormDataBag = new FormDataBag();
		
		formData.addFiles('mainPic', file);
		formData.add('title', $('#title').val());
		formData.add('content', $('#content').val());
		formData.add('shortDescription', $('#shortDescription').val());
		formData.add('keywords', $('#keywords').val());
		formData.add('ownerAlias', $('#ownerAlias').val());
		formData.add('author', $('#author').val());
		
		$('input[type=checkbox]').each(function () {
			formData.add($(this).attr('id'), $(this).val());
		});*/
		
		$.ajax({
			type: 'POST',
			cache: false,
			contentType: false,
			processData: false,
			url: `${admin_panel_url}/mod/blog/articles/edit`,
			// data: formData.getFormData(),
			data: FormUtils.getInputFormDataJson(),
			beforeSend: function () {
				ModernGui.loading(true, 'Modifica articolo in corso');
			},
			success: function () {
				
				switch (action) {
					case 'close':
						location.href = `${admin_panel_url}/mod/blog/articles/new`;
						break;
					default:
						location.reload();
						break;
				} // switch
				
			},
			error: function (xhr) {
				FormUtils.sendNotifications(xhr);
			},
			complete: function () {
				ModernGui.loading(false)
			}
		});
	});
	
	body.on('click', '#deleteArticles', async function () {
		
		if (await ModernGui.confirm('Sei sicuro di voler eliminare questo articolo?')) {
			$.ajax({
				type: 'DELETE',
				url: `${admin_panel_url}/mod/blog/articles/delete/${$(this).data('id')}`,
				beforeSend: function () {
					ModernGui.loading(true, 'Eliminazione articolo in corso...');
				},
				success: function () {
					location.href = `${admin_panel_url}/mod/blog/articles/show`
				},
				complete: function () {
					ModernGui.loading(false)
				}
			})
		} // if
		
	});
	
	
});
