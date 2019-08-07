{{-- -------------------------------------------------------------------------------------------------------------------
  -- Modern GUI
  ----------------------------------------------------------------------------------------------------------------------
  -- Autore: Luca Patera
  -- Versione: 2.0
  -- Dipendenze: JQuery 1.11+, Bootstrap 4+, FontAwesome 4.7+
  -- Descrizione: Questo componenente aggiuntivo fornisce piccole GUI da poter richiamare facilmente tramite JavaScript.
  --}}


<!-- region MODERN LOADING -->
<div id="mloading-gui" class="modal fade fill-in" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog" style="min-width: 100%;">
        <div class="modal-content">
            <div class="modal-body" style="text-align: center">
                <i class="fas fa-circle-notch fa-spin fa-5x fa-fw"></i>
                <h2 id="mloading-message">###</h2>
            </div>
        </div>
    </div>
</div>
<!-- endregion MODERN LOADING -->

<!--region MODERN ALERT-->
<div id="malert-gui" class="modal fade fill-in" data-backdrop="static" data-keyboard="false" tabindex="-1"
     role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="min-width: 100%;">
        <div class="modal-content">
            <div class="modal-body" style="text-align: center">
                <h2 id="malert-message">###</h2>
            </div>
            <div class="modal-footer" style="text-align: center">
                <button type="button" id="malert-ok" data-dismiss="modal" class="btn btn-info"
                        style="min-width:100px;margin: 0 auto;">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>
<!--endregion MODERN ALERT -->

<!--region MODERN CONFIRM-->
<div id="mconfirm-gui" class="modal fade fill-in" data-backdrop="static" data-keyboard="false" tabindex="-1"
     role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="min-width: 100%;padding: 25px;">
        <div class="modal-content">
            <div class="modal-body" style="text-align: center">
                <h2 id="mconfirm-message">###</h2>
            </div>
            <div class="modal-footer" style="text-align: center">
                <div class="btn-group" role="group" style="margin: 0 auto;">
                    <button type="button" id="mconfirm-ok" class="btn btn-info" style="min-width:150px;">
                        OK
                    </button>
                    <button type="button" id="mconfirm-cancel" class="btn btn-default" style="min-width:150px;">
                        Annulla
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--endregion MODERN CONFIRM-->

<!--region MODERN PROMPT-->
<div id="mprompt-gui" class="modal fade fill-in" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog" style="min-width: 100%;">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h2 id="mprompt-message">###</h2>
                <input type="text" id="mprompt-input" class="form-control" autocomplete="off"
                       style="max-width: 800px;margin: 0 auto;"/>
            </div>
            <div class="modal-footer">
                <div class="btn-group" role="group" style="margin: 0 auto;">
                    <button type="button" id="mprompt-ok" class="btn btn-info" style="min-width:150px;">
                        OK
                    </button>
                    <button type="button" id="mprompt-cancel" class="btn btn-default" style="min-width:150px;">
                        Annulla
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--endregion MODERN PROMPT-->


<script type="text/javascript">

  let modernGUI = {
    mloading: {
      gui: $('#mloading-gui'),
      message: $('#mloading-message')
    },
    malert: {
      gui: $('#malert-gui'),
      message: $('#malert-message'),
      ok: $('#malert-ok'),
    },
    mconfirm: {
      gui: $('#mconfirm-gui'),
      message: $('#mconfirm-message'),
      ok: $('#mconfirm-ok'),
      cancel: $('#mconfirm-cancel'),
    },
    mprompt: {
      gui: $('#mprompt-gui'),
      message: $('#mprompt-message'),
      input: $('#mprompt-input'),
      ok: $('#mprompt-ok'),
      cancel: $('#mprompt-cancel'),
    }
  }

  //region MODERN LOADING
  /**
   * Visualizza un'interfaccia di caricamento con eventuale messaggio personalizzato.
   * @param {boolean} status Attiva/disattiva interfaccia.
   * @param {string} [message="Caricamento dei dati in corso..."] Messaggio di caricamento personalizzato.
   * @param {int} [delay=0] Ritardo animazione dell'interfaccia.
   */
  function mloading (status, message) {

    //dati di default
    status = status === undefined ? true : status
    message = message === undefined ? 'Caricamento dei dati in corso...' : message
    let delay = status ? 0 : 500

    //imposto delay e mostro/nascondo gui
    setTimeout(function () {
      if (status) {
        //inserisco messaggio
        modernGUI.mloading.message.html(message)
        modernGUI.mloading.gui.modal('show')
      } else {
        modernGUI.mloading.gui.modal('hide')
      }
    }, delay)
  }

  //endregion MODERN LOADING

  //region MODERN ALERT
  /**
   * Visualizza un'interfaccia di alert.
   * @param {string} message Messaggio da visualizzare.
   */
  function malert (message) {

    //imposto messaggio
    modernGUI.malert.message.html(message)

    //assegno evento click bottone "ok"
    modernGUI.malert.ok.off().on('click', function () {
      modernGUI.malert.gui.modal('hide')
    })

    //mostro gui
    modernGUI.malert.gui.modal('show')
  }

  //endregion MODERN ALERT

  //region MODERN CONFIRM
  /**
   * Visualizza un'interfaccia di conferma.
   * @param {string} message Messaggio da visualizzare.
   * @param {*} callback Callback che restituisce true o false.
   */
  function mconfirm (message, callback) {

    //imposto il messaggio
    modernGUI.mconfirm.message.html(message)

    //evento bottone "ok"
    modernGUI.mconfirm.ok.off().on('click', function () {
      modernGUI.mconfirm.gui.modal('hide')
      callback(true)
    })

    //evento bottone "annulla"
    modernGUI.mconfirm.cancel.off().on('click', function () {
      modernGUI.mconfirm.gui.modal('hide')
      callback(false)
    })

    //mostro la gui
    modernGUI.mconfirm.gui.modal('show')
  }

  //endregion MODERN CONFIRM

  //region MODERN PROMPT
  /**
   * Visualizza un'interfaccia con immissione di testo.
   * @param {string} message Messaggio da visualizzare.
   * @param {*} callback Callback che restituisce lo stato e il testo.
   */
  function mprompt (message, callback) {

    //imposto il messaggio
    modernGUI.mprompt.message.html(message)

    //evento bottone "ok"
    modernGUI.mprompt.ok.off().on('click', function () {
      modernGUI.mprompt.gui.modal('hide')
      callback(true, modernGUI.mprompt.input.val())
      modernGUI.mprompt.input.val('')
    })

    //evento bottone "annulla"
    modernGUI.mprompt.cancel.off().on('click', function () {
      modernGUI.mprompt.gui.modal('hide')
      callback(false, modernGUI.mprompt.input.val())
      modernGUI.mprompt.input.val('')
    })

    //evento input al click dei tasti
    modernGUI.mprompt.input.off().on('keyup', function (e) {
      if (e.keyCode === 13) {
        modernGUI.mprompt.gui.modal('hide')
        callback(true, modernGUI.mprompt.input.val())
        modernGUI.mprompt.input.val('')
      }
    })

    //evento alla visualizzazione della gui
    modernGUI.mprompt.gui.on('shown.bs.modal', function () {
      modernGUI.mprompt.input.focus()
    })

    //mostro la gui
    modernGUI.mprompt.gui.modal('show')
  }

  //endregion MODERN PROMPT

</script>