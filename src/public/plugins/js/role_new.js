$(document).ready(function () {

	$('.action-save').on('click',function(){
		let thisButton=$(this);
		let permissions=[];

		$('input[type=checkbox].data-permissions').each(function () {
			if ($(this).is(':checked')) {
				permissions.push($(this).data('id'));
			}
		});

		$.ajax({
			type: 'POST',
			contentType: 'application/json',
			url: admin_panel_url+'/roles/insert',
			data: JSON.stringify({
				'role_name':$('#role_name').val(),
				'permissions':permissions
			}),
			success: function (data) {

				switch (thisButton.data('action')){
					case 'save':
						location.href=admin_panel_url+'/roles/edit/'+data.id;
						break;
					case 'new':
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