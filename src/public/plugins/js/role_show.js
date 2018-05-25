$(document).ready(function () {

	$('.action-delete').on('click', function () {
		let me = $(this);

		mconfirm('Sei sicuro di voler eliminare questo ruolo?', function (e) {
			if (e) {
				$.ajax({
					type: 'DELETE',
					contentType: 'application/json',
					url: ikpanel_url + '/roles/delete/' + me.data('id'),
					success: function () {
						location.reload();
					},
					error: function (xhr) {
						sendNotifications(xhr);
					},
					beforeSend: function () {
						me.prop('disabled', true);
					},
					complete: function () {
						me.prop('disabled', false);
					}
				}); // Ajax
			}
		});
	});

});