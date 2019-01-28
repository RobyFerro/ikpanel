import FormUtils from "@ikpanel/form_utils";
import ModernGui from "@ikpanel/modern-gui";

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
		let action = $(this).data('action');
		
		$.ajax({
			type: 'POST',
			cache: false,
			contentType: false,
			processData: false,
			url: `${admin_panel_url}/mod/blog/articles/new`,
			data: FormUtils.getInputFormDataJson(),
			beforeSend: function () {
				ModernGui.loading(true, 'Salvataggio articolo in corso...');
			},
			success: function (data) {
				
				switch (action) {
					case 'close':
						location.href = `${admin_panel_url}/mod/blog/articles/edit/${data}`;
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
	
	let fileReader = new FileReader();
	
	$('#main-pic').on('change', function (e) {
		// @ts-ignore
		fileReader.readAsDataURL(e.target.files[0]);
	});
	
	fileReader.onload = function (e) {
		let mainPic = $('#main-pic-preview'),
			mainPicWidth = mainPic.width();
		// @ts-ignore
		mainPic.prop('src', e.target.result);
		mainPic.height(mainPicWidth);
	};
	
});
