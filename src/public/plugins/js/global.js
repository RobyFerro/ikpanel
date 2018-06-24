function getInput(selector) {

    //imposto selettore di default se non impostato
    selector = selector === undefined ? '.form-data' : selector;

    //prendo i valori degli elementi
    let obj = {};
    $(selector).each(function() {

        let value = null;

        if($(this).is('input[type=file]')){
        	return;
        }
        else if($(this).is('input[type=checkbox]')) {
            value = $(this).prop('checked');
        }
        else if($(this).is('select')) {
            value = $(this).find('option:selected').val();
        }
        else if($(this).hasClass('money')) {
            if($(this).val()) {
                value = $(this).maskMoney('unmasked')[0];
            } else {
                value = null;
            }
        }
        else {
            value = $(this).val();
        }

        obj[$(this).prop('id')] = value!==null && value.length === 0 ? null : value;
    });

    //restituisco l'array
    return obj;
}

function getInputFormData(selector) {
	
	//imposto selettore di default se non impostato
	selector = selector === undefined ? '.form-data' : selector;
	
	let formdata=new FormData();
	
	//ottengo i dati di input file
	$(selector).each(function() {
		let value = null;
		
		if($(this).is('input[type=file]')) {
			if($(this)[0].files.length>0){
				value=$(this)[0].files[0];
			}
			else{
				value = '';
			}
		}
		else if($(this).is('input[type=checkbox]')) {
			value = $(this).prop('checked');
		}
		else if($(this).is('select')) {
			value = $(this).find('option:selected').val();
		}
		else if($(this).hasClass('money')) {
			if($(this).val()) {
				value = $(this).maskMoney('unmasked')[0];
			} else {
				value = '';
			}
		}
		else {
			value = $(this).val();
		}
		
		formdata.append($(this).prop('id'),value);
	});
	
	//debug
	let obj=[];
	for(var pair of formdata.entries()) {
		if(pair[0]!=='length'){
			obj[pair[0]]=pair[1];
		}
	}
	console.log(obj);
	
	//restituisco form data
	return formdata;
}

function sendNotifications(xhr) {
	if(xhr.responseText===undefined || xhr.responseText===null){
		return;
	}
	
    var response = JSON.parse(xhr.responseText);
    var errors = response.errors;

    if(response.exception!==undefined){
        $('body').pgNotification({
            "style": "simple",
            "message": '<b>Eccezione: </b>' + response.exception+'<br>'+
            '<b>Messaggio: </b>' + response.message+'<br>'+
            '<b>File: </b>' + response.file+'<br>'+
            '<b>Line: </b>' + response.line,
            "showClose": true,
            "type": "danger"
        }).show();
    }
    else if(errors===undefined){
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

$(document).ready(function() {

    $.ajaxPrefilter(function(options, originalOptions) {
        options.headers = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};
    });

});