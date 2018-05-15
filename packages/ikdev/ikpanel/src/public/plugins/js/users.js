$(function(){
    //INIZIALIZZAZIONE DATA TABLE
    let table = $('table#main_table'),
        save_user = $('button#save'),
        saving_modal = $('#saving'),
        remove_users = $('button.delete');

    table.dataTable({
        sDom: "<'table-responsive't><'row'<p i>>",
        sPaginationType: "bootstrap",
        destroy: true,
        scrollCollapse: true,
        oLanguage: {
            sLengthMenu: "_MENU_ ",
            sInfo: "Stai visualizzando da <b>_START_ a _END_</b> su _TOTAL_ risultati",
            sFilter: 'Cerca',
            sEmptyTable: "Nessun dato disponibile."
        },
        iDisplayLength: 20
    });

    $('#search-table').keyup(function () {
        table.fnFilter($(this).val());
    });

    save_user.on('click', function(){

        saving_modal.find('h2#modal_message').text('Salvataggio del nuovo utente in corso...');
        saving_modal.modal({backdrop: 'static', keyboard: false});

        let obj = {
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
            url: ikpanel_url+'/users/insert',
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
            complete: function(){
                saving_modal.modal('toggle');
            }
        });
    });


    $('body').on('click','button.delete', function(){

        let obj = {
            id: $(this).data('user')
        };

        mconfirm("Sei sicuro di voler eliminare l'utente?", function(e){
            if(e){
                saving_modal.find('h2#modal_message').text('Rimozione utente in corso...');
                saving_modal.modal({backdrop: 'static', keyboard: false});

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: 'application/json',
                    type: 'DELETE',
                    url:'/users/delete',
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
                    complete: function(){
                        saving_modal.modal('toggle');
                    }
                });
            }
        });
    });

});