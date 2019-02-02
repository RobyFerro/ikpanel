import FormUtils from "@ikpanel/form_utils";
import ModernGui from "@ikpanel/modern-gui";

declare let admin_panel_url: string;

$(function () {
	
	let body = $('body');
	
	$('#categoryDescription').ckeditor(function () {
	}, {
		language: 'it',
		height: 500
	});
	
	body.on('click', '.action-save', function () {
		let object = FormUtils.retrieveAllInputs(),
			action = $(this).data('action');
		
		$.ajax({
			type: 'POST',
			url: `${admin_panel_url}/mod/gallery/categories/edit`,
			data: object,
			beforeSend: function () {
				ModernGui.loading(true, 'Modifica categoria in corso');
			},
			success: function () {
				
				switch (action) {
					case 'close':
						location.href = `${admin_panel_url}/mod/gallery/categories/new`;
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
	
	body.on('click', '#deleteCategory', async function () {
		
		if (await ModernGui.confirm('Sei sicuro di voler eliminare questa catagoria?')) {
			$.ajax({
				type: 'DELETE',
				url: `${admin_panel_url}/mod/gallery/categories/delete/${$(this).data('id')}`,
				beforeSend: function () {
					ModernGui.loading(true, 'Eliminazione categoria in corso...');
				},
				success: function () {
					location.href = `${admin_panel_url}/mod/blog/categories/show`
				},
				complete: function () {
					ModernGui.loading(false)
				}
			})
		} // if
		
	});
	
	
});
