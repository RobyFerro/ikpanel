import ModernGui from "@ikpanel/modern-gui";
import FormUtils from "@ikpanel/form_utils";

declare let admin_panel_url: string;

$(function () {
	
	let body = $('body');
	
	$('#content').ckeditor(function () {
	}, {
		language: 'it',
		height: 200
	});
	
	body.on('click', '.action-save', function () {
		let action = $(this).data('action');
		
		$.ajax({
			type: 'POST',
			cache: false,
			contentType: false,
			processData: false,
			url: `${admin_panel_url}/mod/gallery/image/edit`,
			data: FormUtils.getInputFormDataJson(),
			beforeSend: function () {
				ModernGui.loading(true, 'Modifica immagine in corso');
			},
			success: function () {
				
				switch (action) {
					case 'close':
						location.href = `${admin_panel_url}/mod/gallery/images/new`;
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
		
		if (await ModernGui.confirm('Sei sicuro di voler eliminare questa immagine?')) {
			$.ajax({
				type: 'DELETE',
				url: `${admin_panel_url}/mod/gallery/images/delete/${$(this).data('id')}`,
				beforeSend: function () {
					ModernGui.loading(true, 'Eliminazione immagine in corso...');
				},
				success: function () {
					location.href = `${admin_panel_url}/mod/gallery/images/show`
				},
				complete: function () {
					ModernGui.loading(false)
				}
			})
		} // if
		
	});
	
	let fileReader = new FileReader();
	
	$('#pic').on('change', function (e) {
		// @ts-ignore
		fileReader.readAsDataURL(e.target.files[0]);
	});
	
	fileReader.onload = function (e) {
		let mainPic = $('#pic-preview'),
			mainPicWidth = mainPic.width();
		// @ts-ignore
		mainPic.prop('src', e.target.result);
		mainPic.height(mainPicWidth);
	};
	
	
});
