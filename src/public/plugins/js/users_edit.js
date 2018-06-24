$(function () {
	
	$('#role').select2();
	
	$('.action-save').on('click', function() {
		let me = $(this);
		
		$.ajax({
			type: 'PUT',
			contentType: 'application/json',
			url: admin_panel_url+'/users/update',
			data: JSON.stringify(getInput()),
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