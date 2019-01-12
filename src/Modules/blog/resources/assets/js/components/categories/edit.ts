import FormUtils from "../../../../../../../../../../../resources/assets/js/modules/form_utils";
import ModernGui from "../../../../../../../../../../../resources/assets/js/modules/modern-gui";

declare let admin_panel_url: string;

$(function () {
	
	let body = $('body');
	
	$('#categoryDescription').ckeditor(function () {
	}, {
		language: 'it',
		height: 500
	});
	
	body.on('click', '.action-save', function () {
		let object = FormUtils.retrieveAllInputs();
		
		$.ajax({
			type: 'POST',
			url: `${admin_panel_url}/mod/blog/categories/edit`,
			data: object,
			beforeSend: function () {
				ModernGui.loading(true, 'Modifica categoria in corso');
			},
			success: function () {
				location.reload()
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
				url: `${admin_panel_url}/mod/blog/categories/delete/${$(this).data('id')}`,
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