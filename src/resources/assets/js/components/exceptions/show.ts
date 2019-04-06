import Echo from 'laravel-echo';

declare let admin_panel_url: string;

$(function () {
	
	//@ts-ignore
	window.io = require('socket.io-client');
	
	//@ts-ignore
	window.Echo = new Echo({
		broadcaster: 'socket.io',
		host: window.location.hostname + ':6001'
	});
	
	//@ts-ignore
	window.Echo.channel('private-exceptions')
		.listen('.new', function (e) {
			console.log(e);
		});
	
	let body = $('body');
	
	$('#statusFilter').select2({placeholder: 'Seleziona un filtro'});
	
	body.on('change', '#statusFilter', function () {
		window.location.href = `${admin_panel_url}/exceptions/show/${$(this).val()}`;
	});
});
