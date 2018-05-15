$(function () {
    let save_button = $('button#save'),
        saving_modal = $('#saving'),
        delete_button = $('button#delete');

    save_button.on('click', function () {

        saving_modal.find('h2#modal_message').text('Modifica utente in corso...');
        saving_modal.modal({backdrop: 'static', keyboard: false});

        let obj = {
            id: $(this).data('user'),
            mail: $('input#email').val(),
            name: $('input#name').val(),
            surname: $('input#surname').val(),
            password: $('input#password-1').val(),
            password_1: $('input#password-2').val(),
        };

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: 'application/json',
            type: 'PUT',
            url: ikpanel_url+'/users/edit',
            data: JSON.stringify(obj),
            success: function () {
                location.reload();
            },
            error: function (xhr) {

                saving_modal.modal('toggle');
                let response = JSON.parse(xhr.responseText);

                for (let msg in response.errors) {

                    let opt = {
                        "style": "simple",
                        "message": '<span><strong>Attenzione: </strong></span>' + response.errors[msg],
                        "showClose": true,
                        "type": "danger"
                    };

                    $('body').pgNotification(opt).show();

                } // for
            },
            complete: function () {
                saving_modal.modal('toggle');
            }
        });
    });

    $('body').on('click', 'button#delete', function () {

        let obj = {
            id: $(this).data('user')
        };

        mconfirm("Sei sicuro di voler eliminare l'utente?", function (e) {
            saving_modal.find('h2#modal_message').text('Rimozione utente in corso...');
            saving_modal.modal({backdrop: 'static', keyboard: false});

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: 'application/json',
                type: 'DELETE',
                url: ikpanel_url+'/users/delete',
                data: JSON.stringify(obj),
                success: function () {
                    window.location = "/users";
                },
                error: function (xhr) {

                    saving_modal.modal('toggle');
                    let response = JSON.parse(xhr.responseText);

                    for (let msg in response.errors) {

                        let opt = {
                            "style": "simple",
                            "message": '<span><strong>Attenzione: </strong></span>' + response.errors[msg],
                            "showClose": true,
                            "type": "danger"
                        };

                        $('body').pgNotification(opt).show();

                    } // for
                },
                complete: function () {
                    saving_modal.modal('toggle');
                }
            });
        });
    });

});