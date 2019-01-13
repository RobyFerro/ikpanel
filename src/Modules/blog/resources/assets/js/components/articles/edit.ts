import FormUtils from "../../../../../../../../../../../resources/assets/js/modules/form_utils";
import ModernGui from "../../../../../../../../../../../resources/assets/js/modules/modern-gui";

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
		let object = FormUtils.retrieveAllInputs(),
			action = $(this).data('action');
		
		$.ajax({
			type: 'POST',
			url: `${admin_panel_url}/mod/blog/articles/edit`,
			data: object,
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