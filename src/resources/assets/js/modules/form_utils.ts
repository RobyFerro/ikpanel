/*
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

declare let admin_panel_url: any;
declare let app_url: any;

export default class FormUtils {
	
	/**
	 * Inizializza il componente select2 a nazione e città
	 * @param {number} country_id ID nazione-
	 * @param {number} city_id ID città
	 * @param {string} modal ID modal. Se presente
	 * @param {string} side Modalità: back|front
	 */
	static setCountryAndCity(country_id, city_id, side = 'back', modal = null): void {
		
		let baseURL = null,
			parentElement = $('body');
		
		if (modal !== null) {
			parentElement = $(modal);
		} // if
		switch (side) {
			case 'back':
				baseURL = admin_panel_url;
				break;
			case 'front':
				baseURL = app_url;
				break;
		} // switch
		
		let country = $(country_id),
			city = $(city_id),
			option = {
				placeholder: 'Seleziona una città',
				ajax: {
					url: `${baseURL}/cities/0`,
					dataType: 'json',
					data: function (params) {
						return {
							q: params.term,
							page: params.page
						};
					},
					cache: true
				},
				dropdownParent: parentElement,
				language: 'it'
			},
			search_type = country.find(':selected').data('search');
		
		country.select2({
			placeholder: "Seleziona una nazione",
			dropdownParent: parentElement
		});
		
		city.select2({
			placeholder: 'Seleziona una città',
			ajax: {
				/*url: admin_panel_url + '/cities/0',*/
				url: `${baseURL}/cities/${country.val()}/${search_type}`,
				dataType: 'json',
				data: function (params) {
					return {
						q: params.term,
						page: params.page
					};
				},
				cache: true
			},
			dropdownParent: parentElement,
			language: 'it'
		});
		
		country.on('change', function () {
			let search_type = country.find(':selected').data('search');
			
			city.val(null);
			
			option = {
				placeholder: 'Seleziona una città',
				ajax: {
					//url: admin_panel_url + '/cities/' + country.val() + '/' + search_type,
					url: `${baseURL}/cities/${country.val()}/${search_type}`,
					dataType: 'json',
					data: function (params) {
						return {
							q: params.term,
							page: params.page
						};
					},
					cache: true
				},
				dropdownParent: parentElement,
				language: 'it'
			};
			
			city.select2(option);
		});
	}
	
	/**
	 * Imposta i valori ai componenti select2 a nazione e città
	 * @param {number} countryID ID nazione
	 * @param {number} cityID ID città
	 * @param {string} countrySelector Selettore input nazione
	 * @param {string} citySelector Selettore input città
	 */
	static loadCountryAndCity(countryID, cityID, countrySelector = '#country', citySelector = '#city'): Promise<boolean> {
		return new Promise<boolean>((resolve, reject) => {
			let country = $(countrySelector),
				city = $(citySelector);
			
			//nazione
			country.val(countryID).trigger('change');
			
			//città
			$.ajax({
				type: 'GET',
				url: `${admin_panel_url}/city/${cityID}`,
			}).then(function (data) {
				// create the option and append to Select2
				let option = new Option(data.text, data.id, true, true);
				city.append(option).trigger('change');
				
				// manually trigger the `select2:select` event
				city.trigger({
					type: 'select2:select',
					params: {
						data: data
					}
				});
				
				resolve(true);
			}).fail((err) => {
				reject(err);
			});
		});
	}
	
	/**
	 * Inizializza il componente select2 di tipo tag (usato per le skill)
	 * @param {number} skill_id ID input
	 * @param {string} action Azione select2: write|read
	 * @param {string} modal Selettore modal
	 * @param {boolean} hide_disabled
	 */
	static setTags(skill_id, action, modal = 'body', hide_disabled = false) {
		
		let skill = $(skill_id),
			parentModal = $(modal),
			options = null;
		
		switch (action) {
			case 'write':
				options = {
					placeholder: 'Seleziona una skill',
					tags: true,
					multiple: true,
					dropdownParent: parentModal,
					tokenSeparators: [','],
					language: 'it',
					createSearchChoice: function (term, data) {
						
						if ($(data).filter(function () {
							return this.text.localeCompare(term) === 0;
						}).length === 0) {
							return {
								id: term,
								text: term,
								isNew: true
							};
						}
						
					}
				};
				break;
			case 'read':
				options = {
					placeholder: 'Seleziona una skill',
					dropdownParent: parentModal,
					tags: true,
					multiple: true,
					tokenSeparators: [','],
					language: 'it',
					createTag: function (params) {
						return null;
					}
				};
				break;
		}  // switch
		
		if (hide_disabled) {
			options['templateResult'] = function (data, container) {
				if (data.element && $(data.element).data("hide") == true) {
					$(container).addClass('select2hidden');
				}
				return data.text;
			};
		}
		
		skill.select2(options);
		
		skill.off('select2:select select2:unselect').on('select2:select select2:unselect', function () {
			let data = [];
			let current = $(this).select2('data');
			for (let key in current) {
				let item = current[key];
				if (item.id === item.text) {
					if (data.indexOf(item.id) !== -1) {
						$(item.element).remove();
					} else {
						data.push(item.id);
					} // if
				}
			}
		});
		
	}
	
	/**
	 * Imposta i valori di tags nel componente select2 di tipo tag
	 * @param {Array<number>} tags Array di tag
	 * @param {string} selector Selettore input
	 */
	static loadTags(tags, selector = '#skills') {
		let obj = $(selector);
		
		obj.find('option:selected').removeAttr('selected');
		
		for (let key in tags) {
			let item = tags[key];
			obj.find(`option[value=${item}]`).prop('selected', true);
		}
		
		obj.trigger('change', -1);
	}
	
	/**
	 * Ottiene i valori da un input select2 di tipo tag
	 * @param {string} selector Selettore input
	 */
	static getTags(selector) {
		return this.parseSelect2Data($(selector).select2('data'));
	}
	
	/**
	 * Ottiene tutti i campi dalla vista
	 * @param selector
	 * @param id
	 */
	static retrieveAllInputs(selector: string = '.form-data', id: string = 'id') {
		let me = this;
		
		//prendo i valori degli elementi
		let obj = {};
		
		$(selector).each(function () {
			let current = $(this),
				value = null;
			
			if (current.is('input[type=file]')) {
				return null;
			} else if (current.is('input[type=checkbox]')) {
				value = current.prop('checked');
			} else if (current.is('select') && !current.hasClass('tag')) {
				value = current.find('option:selected').val();
			} else if (current.is('input[type=radio]')) {
				value = current.prop('checked');
			} else if (current.is('select') && current.hasClass('tag')) {
				value = me.parseSelect2Data(current.select2('data'));
			} else if (current.hasClass('money')) {
				if (current.val()) {
					value = current.maskMoney('unmasked')[0];
				} else {
					value = null;
				} // if
			} else if (current.hasClass('star-rank-element')) {
				value = current.raty('score');
				value = (value.length == 0) ? 0 : value;
			} else {
				value = current.val();
			} // if
			
			obj[current.attr(id)] =
				value === null || value === undefined || (typeof value === 'string' && value.length === 0) ? null : value;
		});
		
		//restituisco l'array
		return obj;
	}
	
	/**
	 * Ottiene i valori di una select2 di tipo tag
	 * @param data
	 */
	static parseSelect2Data(data) {
		let output = [];
		
		for (let key in data) {
			
			let manual = $(data[key].element).data('select2-tag');
			manual = manual !== undefined;
			
			let item = {
				id: manual ? null : data[key].id * 1,
				text: data[key].text.trim(),
			};
			
			output.push(item);
		}
		
		return output;
	}
	
	/**
	 * Controlla se un modal è aperto
	 * @param modal
	 */
	static isModalOpen(modal: string): boolean {
		let modalIsShown = ($(modal).data('bs.modal') || {})._isShown;
		return !(typeof modalIsShown === 'undefined' || !modalIsShown);
	}
	
	/**
	 * Ritarda l'esecuzione dello script per un tempo definito in millisecondi
	 * @param time Millisecondi
	 */
	static delay(time: number): Promise<void> {
		return new Promise<void>(function (resolve) {
			setTimeout(function () {
				resolve();
			}, time);
		});
	}
	
	/**
	 * Controlla se un array è uguale ad un altro (ignorando posizioni diverse)
	 * @param a
	 * @param b
	 */
	static arraysEqual(a, b): boolean {
		if (a === b) return true;
		if (a == null || b == null) return false;
		if (a.length != b.length) return false;
		
		a.sort();
		b.sort();
		
		for (let i = 0; i < a.length; ++i) {
			if (a[i] !== b[i]) return false;
		}
		return true;
	}
	
	/**
	 * Configura un input personalizzato per gli input file
	 * @param buttonSelector
	 * @param inputSelector
	 * @param textSelector
	 * @param onChange
	 */
	static setInputFile(buttonSelector: string, inputSelector: string, textSelector: string, onChange: () => void = null): void {
		//click bottone custom => trigger input file
		$(buttonSelector).on('click', function () {
			$(inputSelector).trigger('click');
		});
		
		//alla selezione di un nuovo file => trigger evento
		$(inputSelector).on('change', function (e) {
			$(textSelector).val((e.target as HTMLInputElement).files[0].name);
			typeof onChange === 'function' && onChange();
		});
	}
	
	/**
	 * Configura un input personalizzato per gli input file (solo avatar)
	 * @param buttonSelector
	 * @param inputSelector
	 * @param imageSelector
	 * @param onChange
	 */
	static setInputAvatar(buttonSelector: string, inputSelector: string, imageSelector: string, onChange: () => void = null): void {
		let filereader = new FileReader();
		
		//click bottone custom => trigger input file
		$(buttonSelector).on('click', function () {
			$(inputSelector).trigger('click');
		});
		
		//alla selezione di un nuovo file => trigger evento
		$(inputSelector).on('change', function (e) {
			filereader.readAsDataURL((e.target as HTMLInputElement).files[0]);
		});
		
		filereader.onload = function (e: any) {
			let avatar = $(imageSelector),
				avatar_width = avatar.width();
			avatar.prop('src', e.target.result);
			avatar.height(avatar_width);
			typeof onChange === 'function' && onChange();
		};
	}
	
	/**
	 * Imposta un valore nell'input desiderato se l'input è vuoto
	 * @param selector
	 * @param value
	 * @param datepicker
	 */
	static setIfNull(selector: string, value: any, datepicker: boolean = false): void {
		let input = $(selector);
		
		if (String(input.val()).length == 0) {
			if (datepicker) {
				input.datepicker('update', value);
			} else {
				input.val(value);
			}
		}
	}
	
	/**
	 * Ottiene tutti i campi dalla vista in FormData
	 * @param selector
	 * @param id
	 */
	static getInputFormDataJson(selector: string = '.form-data', id: string = 'id'): FormData {
		
		//ottengo i dati di input file
		let formdata = new FormData();
		let values = [];
		$(selector).each(function () {
			let current = $(this),
				item = {
					id: current.prop(id),
					value: null
				};
			
			if (current.is('input[type=file]')) {
				formdata.append(
					current.prop(id),
					(current[0] as HTMLInputElement).files.length > 0 ?
						(current[0] as HTMLInputElement).files[0] : ''
				);
			} else if (current.is('input[type=checkbox]')) {
				item.value = current.prop('checked');
				values.push(item);
			} else if (current.is('select') && !current.hasClass('tag')) {
				item.value = current.find('option:selected').val();
				item.value = item.value === undefined ? null : item.value;
				values.push(item);
			} else if (current.is('select') && current.hasClass('tag')) {
				item.value = FormUtils.parseSelect2Data(current.select2('data'));
				values.push(item);
			} else if (current.hasClass('money')) {
				item.value = current.val() ? current.maskMoney('unmasked')[0] : null;
				values.push(item);
			} else {
				item.value = String(current.val()).length > 0 ? current.val() : null;
				values.push(item);
			}
			
		});
		formdata.append('data', JSON.stringify(values));
		
		//restituisco form data
		return formdata;
	}
	
	/**
	 * Converte un oggetto in un FormData
	 * @param {object} obj
	 * @returns {FormData}
	 */
	public static objectToFormData(obj: object) {
		let formdata: FormData = new FormData();
		formdata.append('data', JSON.stringify(obj));
		return formdata;
	}
	
	/**
	 * Invia una notifica di errore da un xhr (ajax)
	 * @param xhr
	 */
	static sendNotifications(xhr): void {
		if (xhr.responseText === undefined || xhr.responseText === null) {
			return;
		}
		
		let body = $('body'),
			response = JSON.parse(xhr.responseText),
			errors = response.errors;
		
		if (response.exception !== undefined) {
			//@ts-ignore
			body.pgNotification({
				"style": "simple",
				"message": `
					<b>Eccezione: </b> ${response.exception}<br>
					<b>Messaggio: </b> ${response.message}<br>
					<b>File: </b> ${response.file}<br>
					<b>Line: </b> ${response.line}`,
				"showClose": true,
				"type": "danger"
			}).show();
		} else if (errors === undefined) {
			//@ts-ignore
			body.pgNotification({
				"style": "simple",
				"message": `<span><strong>Attenzione: </strong></span> ${response.message}`,
				"showClose": true,
				"type": "danger"
			}).show();
		} else {
			
			for (let err in errors) {
				
				let opt = {
					"style": "simple",
					"message": '<span><strong>Attenzione!</strong></span><br>' + errors[err].join('<br>'),
					"showClose": true,
					"type": "danger"
				};
				//@ts-ignore
				body.pgNotification(opt).show();
			}
		}
	}
	
	/**
	 * Effettua lo stip dei tag HTML
	 * @param data
	 */
	static stripHTML(data) {
		let tmp = document.createElement('div');
		tmp.innerHTML = data;
		return tmp.textContent || tmp.innerText || "";
	}
	
	/**
	 * Maschera input con il template orario 24h
	 * @param {string} selector
	 */
	public static maskTime(selector: string): void {
		
		let maskBehavior = function (val: string) {
			let valA = val.split(":");
			return (parseInt(valA[0]) > 19) ? "HZ:M0" : "H0:M0";
		};
		
		$(selector).mask(maskBehavior, {
			onKeyPress: function (val, e, field, options) {
				field.mask(maskBehavior.apply({}, arguments), options);
			},
			translation: {
				'H': {pattern: /[0-2]/, optional: false},
				'Z': {pattern: /[0-3]/, optional: false},
				'M': {pattern: /[0-5]/, optional: false}
			}
		});
		
	}
}
