/*
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

export default class ModernGui {
	
	private static modernGUI = {
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
	};
	
	/**
	 * Visualizza un'interfaccia di alert
	 * @param {string} message
	 * @returns {Promise<void>}
	 */
	static alert(message: string): Promise<void> {
		let main = this;
		
		return new Promise<void>(function (resolve) {
			
			//imposto messaggio
			main.modernGUI.malert.message.html(message);
			
			//assegno evento click bottone "ok"
			main.modernGUI.malert.ok.off().on('click', function () {
				main.modernGUI.malert.gui.modal('hide');
				resolve();
			});
			
			//mostro gui
			main.modernGUI.malert.gui.modal('show');
		});
	}
	
	/**
	 * Visualizza un'interfaccia di conferma
	 * @param {string} message
	 * @returns {Promise<boolean>}
	 */
	static confirm(message: string): Promise<boolean> {
		let main = this;
		
		return new Promise<boolean>(function (resolve) {
			//imposto il messaggio
			main.modernGUI.mconfirm.message.html(message);
			
			//evento bottone "ok"
			main.modernGUI.mconfirm.ok.off().on('click', function () {
				main.modernGUI.mconfirm.gui.modal('hide');
				resolve(true);
			});
			
			//evento bottone "annulla"
			main.modernGUI.mconfirm.cancel.off().on('click', function () {
				main.modernGUI.mconfirm.gui.modal('hide');
				resolve(false);
			});
			
			//mostro la gui
			main.modernGUI.mconfirm.gui.modal('show');
		});
	}
	
	/**
	 * Visualizza un'interfaccia con immissione di testo
	 * @param {string} message
	 * @returns {Promise<{result: boolean, text: string}>}
	 */
	static prompt(message: string): Promise<{ result: boolean, text: string }> {
		let main = this;
		
		return new Promise<{ result: boolean, text: string }>(function (resolve) {
			//imposto il messaggio
			main.modernGUI.mprompt.message.html(message);
			
			//evento bottone "ok"
			main.modernGUI.mprompt.ok.off().on('click', function () {
				main.modernGUI.mprompt.gui.modal('hide');
				resolve({result: true, text: main.modernGUI.mprompt.input.val().toString()});
				main.modernGUI.mprompt.input.val('');
			});
			
			//evento bottone "annulla"
			main.modernGUI.mprompt.cancel.off().on('click', function () {
				main.modernGUI.mprompt.gui.modal('hide');
				resolve({result: false, text: main.modernGUI.mprompt.input.val().toString()});
				main.modernGUI.mprompt.input.val('');
			});
			
			//evento input al click dei tasti
			main.modernGUI.mprompt.input.off().on('keyup', function (e) {
				if (e.keyCode === 13) {
					main.modernGUI.mprompt.gui.modal('hide');
					resolve({result: true, text: main.modernGUI.mprompt.input.val().toString()});
					main.modernGUI.mprompt.input.val('');
				}
			});
			
			//evento alla visualizzazione della gui
			main.modernGUI.mprompt.gui.on('shown.bs.modal', function () {
				main.modernGUI.mprompt.input.focus();
			});
			
			//mostro la gui
			main.modernGUI.mprompt.gui.modal('show');
		});
	}
	
	/**
	 * Visualizza un'interfaccia di caricamento con eventuale messaggio personalizzato
	 * @param {boolean} status
	 * @param {string} message
	 */
	static loading(status: boolean = true, message: string = 'Caricamento dei dati in corso...'): void {
		let main = this;
		
		//imposto delay e mostro/nascondo gui
		setTimeout(function () {
			if (status) {
				//inserisco messaggio
				main.modernGUI.mloading.message.html(message);
				main.modernGUI.mloading.gui.modal('show');
			} else {
				main.modernGUI.mloading.gui.modal('hide');
			}
		}, status ? 0 : 500);
	}
}
