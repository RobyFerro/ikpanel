import ModernGui from "@ikpanel/modern-gui";
import FormUtils from "@ikpanel/form_utils";
import Notify from "@ikpanel/notify";

declare let admin_panel_url: string;

$(function () {
	let body = $('body'),
		exceptionID = $('input#exceptionID').data('id');
	
	body.on('click', '#resolve', async function () {
		let thisButton = $(this);
		if (await ModernGui.confirm('Sei sicuro di voler risolvere questo errore?')) {
			
			$.ajax({
				type: 'PUT',
				url: `${admin_panel_url}/exceptions/resolve`,
				data: {
					id: exceptionID
				},
				beforeSend: function () {
					ModernGui.loading(true, "Risolvo l'errore selezionato");
				},
				success: function (data) {
					$('#fixed_at').text(data);
					thisButton.hide();
					Notify.success("L'errore è stato risolto correttamente")
				},
				error: function (xhr) {
					FormUtils.sendNotifications(xhr);
				},
				complete: function () {
					ModernGui.loading(false);
				}
			});
		}
	});
	
	body.on('click', '#delete', async function () {
		if (await ModernGui.confirm('Sei sicuro di voler rimuovere questo errore?')) {
			$.ajax({
				type: 'DELETE',
				url: `${admin_panel_url}/exceptions/remove`,
				data: {
					id: exceptionID
				},
				beforeSend: function () {
					ModernGui.loading(true, "Rimuovo l'errore selezionato");
				},
				success: function (data) {
					window.location.href = `${admin_panel_url}/exceptions/show`;
				},
				error: function (xhr) {
					FormUtils.sendNotifications(xhr);
				},
				complete: function () {
					ModernGui.loading(false);
				}
			});
		}
	});
	
	body.on('click', '#restore', async function () {
		if (await ModernGui.confirm('Sei sicuro di voler ripristinare questo errore?')) {
			$.ajax({
				type: 'PUT',
				url: `${admin_panel_url}/exceptions/restore`,
				data: {
					id: exceptionID
				},
				beforeSend: function () {
					ModernGui.loading(true, "Ripristino in corso...");
				},
				success: function (data) {
					location.reload();
				},
				error: function (xhr) {
					FormUtils.sendNotifications(xhr);
				},
				complete: function () {
					ModernGui.loading(false);
				}
			});
		}
	})
});
