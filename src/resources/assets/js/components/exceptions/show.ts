declare let admin_panel_url: string;

$(function () {
	let body = $('body');
	
	$('#statusFilter').select2({
		placeholder: 'Seleziona un filtro'
	});
	
	body.on('change', '#statusFilter', function () {
		window.location.href = `${admin_panel_url}/exceptions/show/${$(this).val()}`;
	});
});
