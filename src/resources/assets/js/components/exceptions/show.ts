import FormUtils from "@ikpanel/form_utils";
import ModernGui from "@ikpanel/modern-gui";
import * as ExceptionTableContent from "../../templates/exceptions/table-rows.hbs";

declare let admin_panel_url: string;

$(function () {
	let body = $('body');
	
	$('#statusFilter').select2({
		placeholder: 'Seleziona un filtro'
	});
	
	body.on('change', '#statusFilter', function () {
		
		$.ajax({
			type: 'GET',
			url: `${admin_panel_url}/exceptions/filter/${$(this).val()}`,
			beforeSend: function () {
				ModernGui.loading(true, 'Caricamento errori in corso...');
			},
			success: function (data) {
				console.log(data);
				$('#errorsTable > tbody').html(ExceptionTableContent({rows: data, adminUrl: admin_panel_url}));
			},
			error: function (xhr) {
				FormUtils.sendNotifications(xhr);
			},
			complete: function () {
				ModernGui.loading(false);
			}
		})
	});
});
