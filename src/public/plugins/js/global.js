function mconfirm(message, callback) {
    //  put message into the body of modal
    $('#mconfirm-gui').on('show.bs.modal', function () {
        //  store current modal reference
        var modal = $(this);

        //  update modal body help text
        modal.find('#mconfirm-message').html(message);
    });

    //  show modal ringer custom confirmation
    $('#mconfirm-gui').modal('show');

    $('#mconfirm-ok').off().on('click', function () {
        // close window
        $('#mconfirm-gui').modal('hide');

        // and callback
        callback(true);
    });

    $('#mconfirm-cancel').off().on('click', function () {
        // close window
        $('#mconfirm-gui').modal('hide');
        // callback
        callback(false);
    });
}

function getInput(selector=null){
	let data=[],
		precision='';

	precision+=selector===null?'':selector;

}

function sendNotifications(xhr){
	var response = JSON.parse(xhr.responseText);
	var errors=response.errors;

	for (var err in errors) {
		var opt = {
			"style": "simple",
			"message": '<span><strong>Attenzione: </strong></span>' + errors[err],
			"showClose": true,
			"type": "danger"
		};

		$('body').pgNotification(opt).show();
	} // for
}

$(document).ready(function () {

	$.ajaxPrefilter(function (options, originalOptions) {
		options.headers = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};
	});

});