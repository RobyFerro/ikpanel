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
		let object = FormUtils.retrieveAllInputs(),
			action = $(this).data('action');
		
		$.ajax({
			type: 'POST',
			url: `${admin_panel_url}/mod/blog/categories/new`,
			data: object,
			beforeSend: function () {
				ModernGui.loading(true, 'Creazione categoria in corso...');
			},
			success: function (data) {
				
				switch (action) {
					case 'close':
						location.reload();
						break;
					default:
						location.href = `${admin_panel_url}/mod/blog/categories/edit/${data}`;
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
	
});