$(function () {
	
	$('#role').select2();
	
	//region AVATAR
	$('#avatar-button').on('click', function() {
		$('#avatar').trigger('click');
	});
	
	let filereader = new FileReader();
	$('#avatar').on('change', function(e) {
		filereader.readAsDataURL(e.target.files[0]);
	});
	
	filereader.onload = function(e) {
		let avatar = $('#avatar-image'),
			avatar_width = avatar.width();
		avatar.prop('src', e.target.result);
		avatar.height(avatar_width);
	};
	//endregion
	
	$('.action-save').on('click', function() {
		let me = $(this);
		
		$.ajax({
			type: 'POST',
			cache: false,
			contentType: false,
			processData: false,
			acceptCharset: 'utf-8',
			url: admin_panel_url+'/users/update',
			data: getInputFormDataJson(),
			success: function (data) {
				
				switch (me.data('action')){
					case 'save':
						location.reload();
						break;
					case 'close':
						location.href=admin_panel_url+'/users/';
						break;
				}
			},
			error: function (xhr) {
				sendNotifications(xhr);
			},
			beforeSend:function(){
				me.prop('disabled',true);
				mloading(true);
			},
			complete: function(){
				me.prop('disabled',false);
				mloading(false);
			}
		});
	});
});