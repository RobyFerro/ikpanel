/*
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

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
		let action = $(this).data('action');
		
		$.ajax({
			type: 'POST',
			cache: false,
			contentType: false,
			processData: false,
			url: `${admin_panel_url}/mod/blog/articles/edit`,
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
