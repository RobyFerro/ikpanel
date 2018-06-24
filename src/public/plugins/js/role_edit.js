$(document).ready(function(){

	$('.action-save').on('click',function(){
		let thisButton=$(this);
		let permissions=[];

		$('input[type=checkbox].data-permissions').each(function () {
			if ($(this).is(':checked')) {
				permissions.push($(this).data('id'));
			}
		});

		$.ajax({
			type: 'PUT',
			contentType: 'application/json',
			url: admin_panel_url+'/roles/update',
			data: JSON.stringify({
				'role_id':$('#role_id').val(),
				'role_name':$('#role_name').val(),
				'permissions':permissions
			}),
			success: function () {
				switch (thisButton.data('action')){
					case 'save':
						location.reload();
						break;
					case 'close':
						location.href=admin_panel_url+'/roles/';
						break;
				}
			},
			error: function (xhr) {
				sendNotifications(xhr);
			},
			beforeSend:function(){
				thisButton.prop('disabled',true);
				mloading(true);
			},
			complete: function(){
				thisButton.prop('disabled',false);
				mloading(false);
			}
		}); // Ajax

	});

});