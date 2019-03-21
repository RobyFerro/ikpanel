import * as $ from 'jquery';

declare let admin_panel_url: string;

window.onerror = function (msg, url, lineNo, columnNo, error) {
	
	let exception = {
		msg: msg,
		url: url,
		line: lineNo,
		column: columnNo,
		error: error
	};
	
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: 'POST',
		url: `${admin_panel_url}/report-exception`,
		data: {
			exception
		},
		success: function () {
			console.log('Exception reported');
		},
		error: function () {
			console.log('Cannot report this exception');
		}
	})
};


