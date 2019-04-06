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
			alert('New error');
		});
	
	let body = $('body');
	
	$('#statusFilter').select2({placeholder: 'Seleziona un filtro'});
	
	body.on('change', '#statusFilter', function () {
		window.location.href = `${admin_panel_url}/exceptions/show/${$(this).val()}`;
	});
	
	body.on('click', '#eventListener', function () {
		if ($(this).hasClass('paused')) {
			$(this).switchClass('paused','listening');
			$(this).html("<i class='fas fa-pause'></i>");
			//@ts-ignore
			window.Echo.channel('private-exceptions')
				.listen('.new', function (e) {
					alert('New error');
				});
		} else if ($(this).hasClass('listening')) {
			$(this).switchClass('listening','paused');
			$(this).html("<i class='fas fa-play'></i>");
			//@ts-ignore
			window.Echo.leave('private-exceptions');
		}
	})
});
