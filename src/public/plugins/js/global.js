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

function mloading(status, message, timeout) {

    status=status===undefined?true:status;
    message=message===undefined?'Caricamento dei dati in corso...':message;
    timeout=timeout===undefined?0:timeout;

    $('#mloading-gui').on('show.bs.modal', function () {
        $(this).find('#mloading-message').html(message);
    });

    setTimeout(function () {
        if(status){
            //  show modal ringer custom confirmation
            $('#mloading-gui').modal('show');
        }
        else{
            $('#mloading-gui').modal('hide');
        }
    }, timeout);
}