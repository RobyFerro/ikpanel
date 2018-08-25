
$(document).ready(function() {
	
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
	
	$('.action-save').on('click',function() {
		var action=$(this).data('action');
		
		$.ajax({
			type: 'POST',
			cache: false,
			contentType: false,
			processData: false,
			acceptCharset: 'utf-8',
			url: admin_panel_url+'/profile/update',
			data: getInputFormDataJson(),
			success: function () {
				
				switch (action){
					case 'save':
						location.reload();
						break;
					case 'close':
						location.href=admin_panel_url+'/';
						break;
				}
			},
			error: function (xhr) {
				sendNotifications(xhr);
			},
			beforeSend:function(){
				mloading(true);
			},
			complete: function(){
				mloading(false);
			}
		});
	});

});