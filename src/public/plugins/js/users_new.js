$(function () {
	
	$('#role').select2({
		placeholder:'Seleziona un ruolo',
		allowClear:false
	});
	
	$('.action-save').on('click', function() {
		let me = $(this);
		
		$.ajax({
			type: 'POST',
			contentType: 'application/json',
			url: admin_panel_url+'/users/insert',
			data: JSON.stringify(getInput()),
			success: function (data) {
				
				switch (me.data('action')){
					case 'save':
						location.href=admin_panel_url+'/users/edit/'+data.id;
						break;
					case 'new':
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