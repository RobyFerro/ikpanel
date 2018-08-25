function getInput(selector) {
	
	//imposto selettore di default se non impostato
	let theselector = selector === undefined ? '.form-data' : selector;
	
	//prendo i valori degli elementi
	let obj = {};
	$(theselector).each(function() {
		let current = $(this),
			value = null;
		
		if(current.is('input[type=file]')) {
			return true;
		}
		else if(current.is('input[type=checkbox]')) {
			console.log('checkbox');
			value = current.prop('checked');
		}
		else if(current.is('select') && !current.hasClass('tag')) {
			value = current.find('option:selected').val();
		}
		else if(current.is('select') && current.hasClass('tag')) {
			value = parseSelect2Data(current.select2('data'));
		}
		else if(current.hasClass('money')) {
			if(current.val()) {
				value = current.maskMoney('unmasked')[0];
			} else {
				value = null;
			}
		}
		else {
			value = current.val();
		}
		
		obj[current.prop('id')] = value === null || (typeof value === 'string' && value.length === 0) ? null : value;
	});
	
	//restituisco l'array
	return obj;
}

function getInputFormData(selector) {
	
	//imposto selettore di default se non impostato
	selector = selector === undefined ? '.form-data' : selector;
	
	//ottengo i dati di input file
	let formdata = new FormData();
	$(selector).each(function() {
		let current = $(this),
			value = '';
		
		if(current.is('input[type=file]')) {
			if(current[0].files.length > 0) {
				value = current[0].files[0];
			}
			else {
				value = '';
			}
		}
		else if(current.is('input[type=checkbox]')) {
			value = current.prop('checked');
		}
		else if(current.is('select') && !current.hasClass('tag')) {
			value = current.find('option:selected').val();
		}
		else if(current.is('select') && current.hasClass('tag')) {
			value = JSON.stringify(parseSelect2Data(current.select2('data')));
		}
		else if(current.hasClass('money')) {
			if(current.val()) {
				value = current.maskMoney('unmasked')[0];
			} else {
				value = '';
			}
		}
		else {
			value = current.val();
		}
		
		formdata.append(current.prop('id'), value);
	});
	
	//debug
	let obj = [];
	for(var pair of formdata.entries()) {
		if(pair[0] !== 'length') {
			obj[pair[0]] = pair[1];
		}
	}
	console.log(obj);
	
	//restituisco form data
	return formdata;
}

function getInputFormDataJson(selector) {
	
	//imposto selettore di default se non impostato
	selector = selector === undefined ? '.form-data' : selector;
	
	//ottengo i dati di input file
	let formdata = new FormData();
	let values = [];
	$(selector).each(function() {
		let current = $(this),
			item = {
				id: current.prop('id'),
				value: null
			};
		
		if(current.is('input[type=file]')) {
			formdata.append(current.prop('id'), current[0].files.length > 0 ? current[0].files[0] : '');
		}
		else if(current.is('input[type=checkbox]')) {
			item.value = current.prop('checked');
			values.push(item);
		}
		else if(current.is('select') && !current.hasClass('tag')) {
			item.value = current.find('option:selected').val();
			item.value=item.value===undefined?null:item.value;
			values.push(item);
		}
		else if(current.is('select') && current.hasClass('tag')) {
			item.value = parseSelect2Data(current.select2('data'));
			values.push(item);
		}
		else if(current.hasClass('money')) {
			item.value = current.val() ? current.maskMoney('unmasked')[0] : null;
			values.push(item);
		}
		else {
			item.value = current.val().length > 0 ? current.val() : null;
			values.push(item);
		}
		
	});
	formdata.append('data', JSON.stringify(values));
	
	//debug
	let obj = [];
	for(var pair of formdata.entries()) {
		if(pair[0] !== 'length') {
			obj[pair[0]] = pair[1];
		}
	}
	console.log(obj);
	
	//restituisco form data
	return formdata;
}

function sendNotifications(xhr) {
	if(xhr.responseText === undefined || xhr.responseText === null) {
		return;
	}
	
	var response = JSON.parse(xhr.responseText);
	var errors = response.errors;
	
	if(response.exception !== undefined) {
		$('body').pgNotification({
			"style": "simple",
			"message": '<b>Eccezione: </b>' + response.exception + '<br>' +
			'<b>Messaggio: </b>' + response.message + '<br>' +
			'<b>File: </b>' + response.file + '<br>' +
			'<b>Line: </b>' + response.line,
			"showClose": true,
			"type": "danger"
		}).show();
	}
	else if(errors === undefined) {
		$('body').pgNotification({
			"style": "simple",
			"message": '<span><strong>Attenzione: </strong></span>' + response.message,
			"showClose": true,
			"type": "danger"
		}).show();
	}
	else {
		
		for(var err in errors) {
			
			var opt = {
				"style": "simple",
				"message": '<span><strong>Attenzione!</strong></span><br>' + errors[err].join('<br>'),
				"showClose": true,
				"type": "danger"
			};
			
			$('body').pgNotification(opt).show();
		}
	}
}

function parseSelect2Data(data) {
	let output = [];
	
	for(let key in data) {
		
		let manual = $(data[key].element).data('select2-tag');
		manual = manual !== undefined;
		
		let item = {
			id: manual ? null : data[key].id * 1,
			text: data[key].text,
		};
		output.push(item);
	}
	
	return output;
}

$(document).ready(function() {
	
	//PREFILTER AJAX
	$.ajaxPrefilter(function(options, originalOptions) {
		options.headers = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};
	});
	
	//MENU PINNER + COOKIE
	//inizializza stato menu
	if (Cookies.get('menu') === undefined) {
		Cookies.set('menu', 'OFF');
	}
	
	//imposto stato menu
	$('#menu-lock').on('click', function () {
		if ($('body').hasClass('menu-pin')) {
			Cookies.set('menu', 'OFF');
		}
		else {
			Cookies.set('menu', 'ON');
		}
	});
	
});