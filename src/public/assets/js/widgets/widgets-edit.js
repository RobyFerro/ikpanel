/******/
(function(modules) { // webpackBootstrap
	/******/ 	// The module cache
	/******/
	var installedModules = {};
	/******/
	/******/ 	// The require function
	/******/
	function __webpack_require__(moduleId) {
		/******/
		/******/ 		// Check if module is in cache
		/******/
		if(installedModules[moduleId]) {
			/******/
			return installedModules[moduleId].exports;
			/******/
		}
		/******/ 		// Create a new module (and put it into the cache)
		/******/
		var module = installedModules[moduleId] = {
			/******/            i: moduleId,
			/******/            l: false,
			/******/            exports: {}
			/******/
		};
		/******/
		/******/ 		// Execute the module function
		/******/
		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
		/******/
		/******/ 		// Flag the module as loaded
		/******/
		module.l = true;
		/******/
		/******/ 		// Return the exports of the module
		/******/
		return module.exports;
		/******/
	}
	
	/******/
	/******/
	/******/ 	// expose the modules object (__webpack_modules__)
	/******/
	__webpack_require__.m = modules;
	/******/
	/******/ 	// expose the module cache
	/******/
	__webpack_require__.c = installedModules;
	/******/
	/******/ 	// define getter function for harmony exports
	/******/
	__webpack_require__.d = function(exports, name, getter) {
		/******/
		if(!__webpack_require__.o(exports, name)) {
			/******/
			Object.defineProperty(exports, name, {enumerable: true, get: getter});
			/******/
		}
		/******/
	};
	/******/
	/******/ 	// define __esModule on exports
	/******/
	__webpack_require__.r = function(exports) {
		/******/
		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
			/******/
			Object.defineProperty(exports, Symbol.toStringTag, {value: 'Module'});
			/******/
		}
		/******/
		Object.defineProperty(exports, '__esModule', {value: true});
		/******/
	};
	/******/
	/******/ 	// create a fake namespace object
	/******/ 	// mode & 1: value is a module id, require it
	/******/ 	// mode & 2: merge all properties of value into the ns
	/******/ 	// mode & 4: return value when already ns object
	/******/ 	// mode & 8|1: behave like require
	/******/
	__webpack_require__.t = function(value, mode) {
		/******/
		if(mode & 1) value = __webpack_require__(value);
		/******/
		if(mode & 8) return value;
		/******/
		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
		/******/
		var ns = Object.create(null);
		/******/
		__webpack_require__.r(ns);
		/******/
		Object.defineProperty(ns, 'default', {enumerable: true, value: value});
		/******/
		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) {
			return value[key];
		}.bind(null, key));
		/******/
		return ns;
		/******/
	};
	/******/
	/******/ 	// getDefaultExport function for compatibility with non-harmony modules
	/******/
	__webpack_require__.n = function(module) {
		/******/
		var getter = module && module.__esModule ?
			/******/            function getDefault() {
				return module['default'];
			} :
			/******/            function getModuleExports() {
				return module;
			};
		/******/
		__webpack_require__.d(getter, 'a', getter);
		/******/
		return getter;
		/******/
	};
	/******/
	/******/ 	// Object.prototype.hasOwnProperty.call
	/******/
	__webpack_require__.o = function(object, property) {
		return Object.prototype.hasOwnProperty.call(object, property);
	};
	/******/
	/******/ 	// __webpack_public_path__
	/******/
	__webpack_require__.p = "/";
	/******/
	/******/
	/******/ 	// Load entry module and return exports
	/******/
	return __webpack_require__(__webpack_require__.s = 15);
	/******/
})
/************************************************************************/
/******/({
	
	/***/ "./src/resources/assets/js/components/widgets/widgets-edit.ts":
	/*!********************************************************************!*\
	  !*** ./src/resources/assets/js/components/widgets/widgets-edit.ts ***!
	  \********************************************************************/
	/*! no static exports found */
	/***/ (function(module, exports, __webpack_require__) {
		
		"use strict";
		
		Object.defineProperty(exports, "__esModule", {value: true});
		var widgets_edit_1 = __webpack_require__(/*! ../../modules/widgets/widgets_edit */ "./src/resources/assets/js/modules/widgets/widgets_edit.js");
		$(function() {
			var builder = new widgets_edit_1.default($('#roleID').data('id'));
			builder.isCurrentFormStatic = true;
			builder.init();
			builder.currentForm = 1;
		});
		
		
		/***/
	}),
	
	/***/ "./src/resources/assets/js/modules/composer.js":
	/*!*****************************************************!*\
	  !*** ./src/resources/assets/js/modules/composer.js ***!
	  \*****************************************************/
	/*! no static exports found */
	/***/ (function(module, exports, __webpack_require__) {
		
		"use strict";
		
		
		var __awaiter = this && this.__awaiter || function(thisArg, _arguments, P, generator) {
			return new (P || (P = Promise))(function(resolve, reject) {
				function fulfilled(value) {
					try {
						step(generator.next(value));
					} catch(e) {
						reject(e);
					}
				}
				
				function rejected(value) {
					try {
						step(generator["throw"](value));
					} catch(e) {
						reject(e);
					}
				}
				
				function step(result) {
					result.done ? resolve(result.value) : new P(function(resolve) {
						resolve(result.value);
					}).then(fulfilled, rejected);
				}
				
				step((generator = generator.apply(thisArg, _arguments || [])).next());
			});
		};
		
		var __generator = this && this.__generator || function(thisArg, body) {
			var _ = {
					label: 0,
					sent: function sent() {
						if(t[0] & 1) throw t[1];
						return t[1];
					},
					trys: [],
					ops: []
				},
				f,
				y,
				t,
				g;
			return g = {
				next: verb(0),
				"throw": verb(1),
				"return": verb(2)
			}, typeof Symbol === "function" && (g[Symbol.iterator] = function() {
				return this;
			}), g;
			
			function verb(n) {
				return function(v) {
					return step([n, v]);
				};
			}
			
			function step(op) {
				if(f) throw new TypeError("Generator is already executing.");
				
				while(_) {
					try {
						if(f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
						if(y = 0, t) op = [op[0] & 2, t.value];
						
						switch(op[0]) {
							case 0:
							case 1:
								t = op;
								break;
							
							case 4:
								_.label++;
								return {
									value: op[1],
									done: false
								};
							
							case 5:
								_.label++;
								y = op[1];
								op = [0];
								continue;
							
							case 7:
								op = _.ops.pop();
								
								_.trys.pop();
								
								continue;
							
							default:
								if(!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) {
									_ = 0;
									continue;
								}
								
								if(op[0] === 3 && (!t || op[1] > t[0] && op[1] < t[3])) {
									_.label = op[1];
									break;
								}
								
								if(op[0] === 6 && _.label < t[1]) {
									_.label = t[1];
									t = op;
									break;
								}
								
								if(t && _.label < t[2]) {
									_.label = t[2];
									
									_.ops.push(op);
									
									break;
								}
								
								if(t[2]) _.ops.pop();
								
								_.trys.pop();
								
								continue;
						}
						
						op = body.call(thisArg, _);
					} catch(e) {
						op = [6, e];
						y = 0;
					} finally {
						f = t = 0;
					}
				}
				
				if(op[0] & 5) throw op[1];
				return {
					value: op[0] ? op[1] : void 0,
					done: true
				};
			}
		};
		
		Object.defineProperty(exports, "__esModule", {
			value: true
		});
		
		var form_utils_1 = __webpack_require__(/*! ./form_utils */ "./src/resources/assets/js/modules/form_utils.js");
		
		var notify_1 = __webpack_require__(/*! ./notify */ "./src/resources/assets/js/modules/notify.js");
		
		var utils_1 = __webpack_require__(/*! ./utils */ "./src/resources/assets/js/modules/utils.js");
		
		var modern_gui_1 = __webpack_require__(/*! ./modern-gui */ "./src/resources/assets/js/modules/modern-gui.js");
		
		var Composer =
			/** @class */
			function() {
				function Composer() {
					//endregion
					//region VARIABILI
					//current form statico
					this.isCurrentFormStatic = false; //rotte
					
					this.routes = {
						availableComponents: null,
						formComponents: null,
						saveForm: null
					}; //tabs
					
					this.tabs = []; //selettori html
					
					this.selector = {
						tab_presets: $('#tab-presets'),
						tab_unbounds: $('#tab-unbounds'),
						add_row_button: $('#builder-add-row-button'),
						add_row_modal: $('#modal-add-row'),
						add_row_add_column: $('#modal-add-row-add-column'),
						add_row_content: $('#modal-add-row-content')
					}; //variabile private delle proprietà
					
					this._currentForm = null;
					this._availableComponents = [];
					this._currentComponents = [];
					this._selectedComponent = null; //endregion
				}
				
				Object.defineProperty(Composer.prototype, "selectedComponent", {
					//region PROPRIETÀ CLASSE
					get: function get() {
						return this._selectedComponent;
					},
					set: function set(value) {
						this._selectedComponent = value;
					},
					enumerable: true,
					configurable: true
				});
				Object.defineProperty(Composer.prototype, "currentForm", {
					get: function get() {
						return this._currentForm;
					},
					set: function set(value) {
						this._currentForm = value;
						this.onCurrentFormChange();
					},
					enumerable: true,
					configurable: true
				});
				Object.defineProperty(Composer.prototype, "availableComponents", {
					get: function get() {
						return this._availableComponents;
					},
					set: function set(value) {
						this._availableComponents = value;
						this.onAvailableComponentsSet();
					},
					enumerable: true,
					configurable: true
				});
				Object.defineProperty(Composer.prototype, "currentComponents", {
					get: function get() {
						return this._currentComponents;
					},
					set: function set(value) {
						this._currentComponents = value;
						this.onCurrentComponentsSet();
					},
					enumerable: true,
					configurable: true
				}); //endregion
				//region METODI GESTIONE CLASSE
				
				/**
				 * Inizializza componenti html + eventi
				 * @return {Promise<void>}
				 */
				
				Composer.prototype.init = function() {
					return __awaiter(this, void 0, void 0, function() {
						var main, body, modalAddComponent, available_components_select, _a;
						
						return __generator(this, function(_b) {
							switch(_b.label) {
								case 0:
									main = this, body = $('body'), modalAddComponent = $('#modal-add-component'), available_components_select = $('#available-components-select'); //region INIZIALIZZAZIONI COMPONENTI
									//inizializzo tooltip => BOTTONI SALVATAGGIO, RIMUOVI COMPONENTE
									
									body.tooltip({
										selector: '.builder-remove-row, .builder-remove-component',
										trigger: 'hover',
										placement: 'bottom'
									}); //inizializzo select2 => POSIZIONE (MODAL AGGIUNGI COMPONENTE)
									
									$('#component-position').select2({
										placeholder: 'Seleziona posizione...',
										dropdownParent: modalAddComponent
									}); //inizializzo select2 => PUNTEGGIO (MODAL AGGIUNGI COMPONENTE)
									
									$('#component-ranktype').select2({
										placeholder: 'Seleziona tipologia punteggio...',
										dropdownParent: modalAddComponent
									}); //inizializzo sortable => RIGHE DEL FORM (GRIGLIA)
									
									$('#builder-grid').sortable({
										items: "> div",
										cursor: 'move',
										opacity: 0.8,
										handle: '.builder-sort-row',
										placeholder: 'builder-placeholder-row',
										helper: function helper(e, tr) {
											var $originals = tr.children();
											var $helper = tr.clone();
											$helper.children().each(function(index) {
												$(this).width($originals.eq(index).width());
												$(this).width($originals.eq(index).width());
											});
											return $helper;
										},
										start: function start(event, ui) {
											ui.placeholder.html('Rilascia qui');
										},
										update: function update() {
											//prendo gli indici correnti
											var indexes = $(this).sortable('toArray', {
												attribute: 'data-index'
											}).map(function(x) {
												return Number(x);
											}); //riordino le righe dei componenti
											
											var form = [];
											indexes.forEach(function(item) {
												form.push(main.currentComponents[item]);
											}); //riaggiorno gli indici
											
											$('#builder-grid').children('div').each(function(index) {
												$(this).removeAttr('data-index').attr('data-index', index);
											}); //salvo il nuovo oggetto
											
											main.currentComponents = form;
										}
									}); //inizializzo select2 => TABS COMPONENTI DISPONIBILI
									
									available_components_select.select2({
										dropdownParent: $('#builder-content'),
										minimumResultsForSearch: -1,
										containerCssClass: 'composer'
									});
									available_components_select.empty();
									$('#available-components-tab-content').empty();
									main.tabs.forEach(function(value, index) {
										//creo opzioni per select2 tabs
										var option = "<option id=\"" + index + "\" data-id=\"tab-" + value.id + "\" " + (index === 0 ? 'selected' : '') + ">" + value.title + "</option>";
										available_components_select.append(option); //creo pannelli per tabs
										
										var content = "\n\t\t\t<div class=\"tab-pane tab-components fade show " + (index === 0 ? 'active' : '') + "\" id=\"tab-" + value.id + "\" role=\"tabpanel\">\n\t\t\t\t<div class=\"p-3\">Caricamento in corso...</div>\n\t\t\t</div>\n\t\t\t";
										$('#available-components-tab-content').append(content);
									});
									available_components_select.trigger('change.select2'); //endregion
									//region EVENTI COMPONENTI
									//click bottone => NUOVA RIGA
									
									main.selector.add_row_button.on('click', function() {
										if(main.currentForm !== null) {
											main.clearNewRow();
											main.checkAddColumn();
											main.selector.add_row_modal.modal('show');
										} else {
											notify_1.default.danger('Non hai selezionato nessun form!');
										}
									}); //click bottone => RIMUOVI RIGA
									
									body.on('click', '.builder-remove-row', function() {
										var index = $(this).parents('.builder-row').data('index');
										$(this).tooltip('dispose');
										main.currentComponents.splice(index, 1);
										main.renderGrid();
									}); //click bottone => SALVA RIGA (MODAL NUOVA RIGA)
									
									$('#modal-add-row-save').on('click', function() {
										var data = main.getNewRow();
										
										if(data.total !== 12) {
											notify_1.default.danger('Le colonne nella riga non sono 12!');
										} else {
											var columns = [];
											
											for(var i in data.columns) {
												var item = data.columns[i];
												columns.push({
													span: item
												});
											}
											
											main.currentComponents.push(columns);
											main.renderGrid();
											main.selector.add_row_modal.modal('hide');
										}
									}); //click bottone => NUOVA COLONNA
									
									main.selector.add_row_add_column.on('click', function(e) {
										e.preventDefault();
										main.addNewColumn();
									}); //click bottone => RIMUOVI COLONNA
									
									body.on('click', '.modal-add-row-remove-column', function() {
										$(this).closest('.builder-new-column').remove();
										main.refreshColumnsLabel();
										main.checkAddColumn();
									}); //click bottone => SALVA COLONNA (MODAL NUOVA RIGA)
									
									body.on('click', '.builder-column-save', function() {
										var parent = $(this).closest('.builder-new-column');
										var value = parent.find('select.modal-add-row-column-size').val();
										
										if(String(value).length > 0) {
											parent.find('span.builder-column-size-label').show();
											parent.find('span.builder-column-size-text').html(String(value));
											parent.find('select.modal-add-row-column-size').hide().select2('destroy');
											$(this).hide();
											parent.find('.modal-add-row-remove-column').show();
											main.checkAddColumn();
										} else {
											notify_1.default.danger('Seleziona un elemento!');
										}
									}); //click link => COMPONENTE DISPONIBILE
									
									body.on('click', '.available-component', function(e) {
										e.preventDefault();
										main.selectedComponent = $(this).data('code');
										var component_option = main.getAvailableComponentByCode(main.selectedComponent);
										$('#component-name').html(component_option.description);
										$('#component-description').val('');
										
										if(component_option.custom_label) {
											$('#component-description-content').show();
										} else {
											$('#component-description-content').hide();
										}
										
										$('#component-options-items').empty();
										
										if(component_option.type == 'SELECT' && !component_option.preset) {
											$('#component-options-content').show();
										} else {
											$('#component-options-content').hide();
										}
										
										if(component_option.code == 'range' || component_option.code == 'star') {
											$('#component-ranktype-content').show();
										} else {
											$('#component-ranktype-content').hide();
										}
										
										$('#modal-add-component').modal('show');
									}); //click bottone => RIMUOVI COMPONENTE
									
									body.on('click', '.builder-remove-component', function() {
										var row = $(this).data('row');
										var col = $(this).data('col');
										$(this).tooltip('dispose');
										var properties = Object.getOwnPropertyNames(main.currentComponents[row][col]);
										
										for(var i in properties) {
											if(properties[i] !== 'span') {
												delete main.currentComponents[row][col][properties[i]];
											}
										}
										
										main.renderGrid();
									}); //click bottone => SALVA COMPONENTE (MODAL AGGIUNGI COMPONENTE)
									
									$('#modal-add-component-save').on('click', function() {
										var componentDescription = $('#component-description');
										var componentRankType = $('#component-ranktype');
										var position = $('#component-position').val();
										
										if(position.toString().length > 0 && main.isPositionValid(position)) {
											var indexes = main.getColumnFromPosition(Number(position));
											var component_data = main.getAvailableComponentByCode(main.selectedComponent);
											var component_options_1 = [];
											$('.component-option-text').each(function() {
												component_options_1.push(String($(this).val()));
											});
											
											if(component_data.custom_label && componentDescription.val().toString().length == 0 || !component_data.preset && component_data.type == 'SELECT' && component_options_1.filter(function(x) {
												return x.toString().length == 0;
											}).length > 0 || ['range', 'star'].includes(component_data.code) && componentRankType.val().toString().length == 0) {
												notify_1.default.danger('Parametri non corretti!');
											} else {
												main.currentComponents[indexes.row][indexes.col].code = main.selectedComponent;
												
												if(component_data.custom_label) {
													main.currentComponents[indexes.row][indexes.col].description = componentDescription.val().toString();
												}
												
												if(!component_data.preset && component_data.type == 'SELECT') {
													main.currentComponents[indexes.row][indexes.col].options = component_options_1;
												}
												
												if(['range', 'star'].includes(component_data.code)) {
													main.currentComponents[indexes.row][indexes.col].description = componentRankType.find('option:selected').text();
													main.currentComponents[indexes.row][indexes.col].ranktype = Number(componentRankType.val());
												}
												
												main.selectedComponent = null;
												main.renderGrid();
												$('#modal-add-component').modal('hide');
											}
										} else {
											notify_1.default.danger('Parametri non corretti!');
										}
									}); //click bottone => SALVA FORM
									
									$('#builder-save').on('click', function() {
										return __awaiter(this, void 0, void 0, function() {
											return __generator(this, function(_a) {
												switch(_a.label) {
													case 0:
														if(!(main.currentForm !== null)) return [3
															/*break*/
															, 2];
														modern_gui_1.default.loading(true, 'Salvataggio form in corso...');
														return [4
															/*yield*/
															, main.saveForm()];
													
													case 1:
														_a.sent();
														
														modern_gui_1.default.loading(false);
														notify_1.default.success('Il form è stato salvato correttamente!');
														return [3
															/*break*/
															, 3];
													
													case 2:
														notify_1.default.danger('Non hai selezionato nessun form!');
														_a.label = 3;
													
													case 3:
														return [2
															/*return*/
														];
												}
											});
										});
									}); //click link "Menu a tendina" => AGGIUNGI NUOVA OPZIONE (MODAL AGGIUNGI COMPONENTE)
									
									$('#component-options-add').on('click', function(e) {
										e.preventDefault();
										$('#component-options-items').append("\n\t\t\t\t<div class=\"input-group input-group-sm mb-1 component-option\">\n\t\t\t\t\t<input type=\"text\" class=\"form-control component-option-text\">\n\t\t\t\t\t<div class=\"input-group-append\">\n\t\t\t\t\t\t<button class=\"btn btn-outline-secondary component-option-remove\" type=\"button\">\n\t\t\t\t\t\t\t<i class=\"fas fa-times fa-fw\"></i>\n\t\t\t\t\t\t</button>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t");
									}); //click bottone => RIMUOVI OPZIONE (MODAL AGGIUNGI COMPONENTE)
									
									body.on('click', '.component-option-remove', function() {
										$(this).parents('div.component-option').remove();
									}); //click bottone da tastiera INVIO/ESC => AGGIUNGI/RIMUOVI OPZIONE (MODAL AGGIUNGI COMPONENTE)
									
									body.on('keyup', '.component-option-text', function(e) {
										switch(e.keyCode) {
											case 13:
												//TASTO INVIO
												$('#component-options-items').append("\n\t\t\t\t\t\t<div class=\"input-group input-group-sm mb-1 component-option\">\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control component-option-text\">\n\t\t\t\t\t\t\t<div class=\"input-group-append\">\n\t\t\t\t\t\t\t\t<button class=\"btn btn-outline-secondary component-option-remove\" type=\"button\">\n\t\t\t\t\t\t\t\t\t<i class=\"fas fa-times fa-fw\"></i>\n\t\t\t\t\t\t\t\t</button>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t");
												$(this).parent().next('div.component-option').find('input.component-option-text').focus();
												break;
											
											case 27:
												//TASTO ESC
												$(this).parent().prev('div.component-option').find('input.component-option-text').focus();
												$(this).parents('div.component-option').remove();
												break;
										}
									}); //click opzione select => MOSTRA PANNELLO TAB (COMPONENTI DISPONIBILI)
									
									body.on('change', '#available-components-select', function() {
										var code = $(this).find(':selected').data('id').toString();
										$('.tab-components').removeClass('show active');
										$('#' + code).addClass('show active');
									}); //endregion
									//carica la lista dei componenti disponibili
									
									_a = main;
									return [4
										/*yield*/
										, main.getAvailableComponents()];
								
								case 1:
									//endregion
									//carica la lista dei componenti disponibili
									_a.availableComponents = _b.sent();
									return [2
										/*return*/
									];
							}
						});
					});
				};
				/**
				 * Svuota tutte le righe dal modal di creazione righe
				 */
				
				
				Composer.prototype.clearNewRow = function() {
					this.selector.add_row_content.empty();
				};
				/**
				 * Funzionamento logica modal di creazione righe
				 */
				
				
				Composer.prototype.checkAddColumn = function() {
					var main = this,
						body = $('body'); //prendo tutti i campi colonna
					
					var columns = body.find('.builder-new-column .modal-add-row-column-size'); //totale campi
					
					var total_fields = columns.length; //totale campi compilati
					
					var notempty_fields = 0;
					columns.each(function() {
						if(String($(this).val()).length > 0) {
							notempty_fields++;
						}
					}); //totale somma dei valori dei campi
					
					var total = 0;
					columns.each(function() {
						total += Number($(this).val());
					}); //mostro/nascondo link "Aggiungi colonna"
					
					if(total_fields == notempty_fields && total < 12) {
						main.selector.add_row_add_column.show();
					} else {
						main.selector.add_row_add_column.hide();
					} //abilita/disabilita bottone "Salva" (nuova riga)
					
					
					if(total === 12) {
						$('#modal-add-row-save').removeAttr('disabled');
					} else {
						$('#modal-add-row-save').attr('disabled', 'disabled');
					} //mostra/nascondi bottone "Rimuovi colonna"
					
					
					if($('.builder-column-save:visible').length > 0) {
						$('.modal-add-row-remove-column').hide();
					} else {
						$('.modal-add-row-remove-column').show();
					}
				};
				/**
				 * Aggiunge una nuova colonna nel modal di creazione righe
				 */
				
				
				Composer.prototype.addNewColumn = function() {
					var main = this,
						body = $('body'),
						output = '',
						uuid = utils_1.default.uuid();
					output += "\n\t\t\t<div class=\"row builder-new-column\" style=\"margin-bottom: 5px;\">\n\t\t\t\t<div class=\"col-md-4\">\n\t\t\t\t\t<span style=\"vertical-align: -6px;\">\n\t\t\t\t\t\tColonna <span class=\"builder-new-column-iteration\"></span>\n\t\t\t\t\t</span>\n\t\t\t\t</div>\n\t\t\t\t<div class=\"col-md-6\">\n\t\t\t\t\t<select class=\"form-control full-width modal-add-row-column-size\" data-uuid=\"" + uuid + "\" autocomplete=\"off\">\n\t\t\t\t\t\t<option></option>\n\t\t\t\t\t\t" + main.buildOptions() + "\n\t\t\t\t\t</select>\n\t\t\t\t\t<span class=\"label label-info builder-column-size-label\" style=\"display: none;vertical-align: -6px;\">\n\t\t\t\t\t\tSpan: <span class=\"builder-column-size-text\"></span>\n\t\t\t\t\t</span>\n\t\t\t\t</div>\n\t\t\t\t<div class=\"col-md-2 text-right\">\n\t\t\t\t\t<i class=\"fas fa-times-circle cursor-pointer modal-add-row-remove-column\"\n\t\t\t\t\tstyle=\"vertical-align: -6px;display: none;\"></i>\n\t\t\t\t\t<button class=\"btn btn-info btn-xs builder-column-save\" style=\"vertical-align: -6px;\">\n\t\t\t\t\t\tSalva\n\t\t\t\t\t</button>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t";
					main.selector.add_row_content.append(output);
					body.find(".modal-add-row-column-size[data-uuid=\"" + uuid + "\"]").select2({
						placeholder: 'Seleziona dimensione...',
						dropdownParent: $('#modal-add-row')
					});
					main.refreshColumnsLabel();
					main.checkAddColumn();
				};
				/**
				 * Popola select span nuova colonna nel modal di creazione righe
				 * @param {any} selected
				 * @return {string}
				 */
				
				
				Composer.prototype.buildOptions = function(selected) {
					if(selected === void 0) {
						selected = null;
					}
					
					var body = $('body'); //prendo tutti i campi colonna
					
					var columns = body.find('.builder-new-column .modal-add-row-column-size'); //totale somma dei valori dei campi
					
					var total = 0;
					columns.each(function() {
						total += Number($(this).val());
					});
					var output = '';
					
					for(var i = 1; i <= 12 - total; i++) {
						output += "<option value=\"" + i + "\" " + (selected === i ? 'selected' : '') + ">Span " + i + "</option>";
					}
					
					return output;
				};
				/**
				 * Aggiorna il numero del label della colonna nel modal di creazione righe
				 */
				
				
				Composer.prototype.refreshColumnsLabel = function() {
					$('.builder-new-column').each(function(index) {
						$(this).find('.builder-new-column-iteration').html(String(index + 1));
					});
				};
				/**
				 * Ottiene i dati della nuova riga del modal di creazione righe
				 */
				
				
				Composer.prototype.getNewRow = function() {
					var columns = $('body').find('.builder-new-column .modal-add-row-column-size');
					var values = []; //totale somma dei valori dei campi
					
					var total = 0;
					columns.each(function() {
						total += Number($(this).val());
						values.push(Number($(this).val()));
					});
					return {
						total: total,
						columns: values
					};
				};
				/**
				 * Ottiene il componente disponibile tramite il suo codice
				 * @param {string} code
				 * @return {IAvailableComponent}
				 */
				
				
				Composer.prototype.getAvailableComponentByCode = function(code) {
					return this.availableComponents.find(function(x) {
						return x.code == code;
					});
				};
				/**
				 * Verifica che la posizione sia valida
				 * @param n
				 * @return {boolean}
				 */
				
				
				Composer.prototype.isPositionValid = function(n) {
					var main = this,
						index = 0;
					
					for(var i in main.currentComponents) {
						var row = main.currentComponents[i];
						index += row.length;
					}
					
					if(index === 0) {
						return false;
					}
					
					return n >= 1 && n <= index;
				};
				/**
				 * Restituisce gli indici
				 * @param {number} n
				 * @return {row:number, col:number}
				 */
				
				
				Composer.prototype.getColumnFromPosition = function(n) {
					var main = this,
						index = 0;
					
					for(var i in main.currentComponents) {
						var row = main.currentComponents[i];
						
						for(var j in row) {
							index++;
							
							if(n === index) {
								return {
									row: Number(i),
									col: Number(j)
								};
							}
						}
					}
					
					return {
						row: null,
						col: null
					};
				};
				/**
				 * Compone l'url col dominio admin
				 * @param {string} url
				 * @return {string}
				 */
				
				
				Composer.prototype.admin_url = function(url) {
					return admin_panel_url + "/" + url;
				}; //endregion
				//region RICHIESTE AJAX
				
				/**
				 * Ottiene tutti i componenti disponibili
				 * @return {Promise<void>}
				 */
				
				
				Composer.prototype.getAvailableComponents = function() {
					var main = this;
					return new Promise(function(resolve, reject) {
						$.ajax({
							cache: false,
							type: 'GET',
							url: main.admin_url(main.routes.availableComponents),
							success: function success(data) {
								resolve(data);
							},
							error: function error(xhr) {
								form_utils_1.default.sendNotifications(xhr);
								reject(xhr.responseText);
							}
						});
					});
				};
				/**
				 * Ottiene tutti i componenti del form corrente
				 * @return {Promise<void>}
				 */
				
				
				Composer.prototype.getFormComponents = function() {
					var main = this;
					return new Promise(function(resolve, reject) {
						$.ajax({
							cache: false,
							type: 'GET',
							url: main.admin_url(main.routes.formComponents + (main.isCurrentFormStatic ? '' : "/" + main.currentForm)),
							success: function success(data) {
								resolve(data);
							},
							error: function error(xhr) {
								form_utils_1.default.sendNotifications(xhr);
								reject(xhr.responseText);
							}
						});
					});
				};
				/**
				 * Salva tutti i componenti del form corrente
				 * @return {Promise<void>}
				 */
				
				
				Composer.prototype.saveForm = function() {
					var main = this;
					return new Promise(function(resolve, reject) {
						$.ajax({
							cache: false,
							type: 'POST',
							url: main.admin_url(main.routes.saveForm),
							contentType: 'application/json',
							data: JSON.stringify({
								form: main.currentForm,
								data: main.currentComponents
							}),
							success: function success(data) {
								resolve(data);
							},
							error: function error(xhr) {
								form_utils_1.default.sendNotifications(xhr);
								reject(xhr.responseText);
							}
						});
					});
				}; //endregion
				//region RENDERING
				
				/**
				 * Renderizza i componenti disponibili
				 * @param {JQuery} selector
				 * @param {Array<IAvailableComponent>} items
				 */
				
				
				Composer.prototype.renderAvailableComponents = function(selector, items) {
					var render = '';
					render += "<div class=\"list-group list-group-thin list-available-components\">";
					
					for(var i in items) {
						var item = items[i];
						render += "\n\t\t\t\t<a href=\"#\" class=\"list-group-item list-group-item-action available-component\"\n\t\t\t\tdata-code=\"" + item.code + "\">\n\t\t\t\t\t" + item.description + "\n\t\t\t\t</a>\n\t\t\t";
					}
					
					render += "</div>";
					selector.html(render);
				};
				/**
				 * Renderizza i componenti del form (GRIGLIA)
				 */
				
				
				Composer.prototype.renderGrid = function() {
					var main = this,
						output = '',
						grid = $('#builder-grid');
					var index = 0;
					
					if(main.currentComponents.length > 0) {
						grid.empty();
						
						for(var i in main.currentComponents) {
							var row = main.currentComponents[i];
							output += "\n\t\t\t\t\t<div class=\"row mb-3 builder-row\" style=\"padding: 0 25px;position: relative;\"\n\t\t\t\t\tdata-index=\"" + i + "\">\n\t\t\t\t\t<i class=\"fas fa-ellipsis-v fa-fw builder-sort-row\"></i>\n\t\t\t\t";
							
							for(var j in row) {
								var column = row[j];
								var component_option = main.getAvailableComponentByCode(column.code);
								index++;
								output += "\n\t\t\t\t\t\t<div class=\"col-md-" + column.span + " builder-column cursor-move noselect\" data-index=\"" + j + "\">\n\t\t\t\t\t\t\t<div class=\"builder-column " + (column.hasOwnProperty('code') ? 'bg-light' : 'bg-warning') + "\" style=\"min-height: 35px;border: solid 1px #f0f0f0;position: relative;text-align: center;\">\n\t\t\t\t\t\t\t\t<span style=\"position: absolute;left: 0;right: 0;margin: 0 auto;font-weight: bold;line-height: 31px;\">\n\t\t\t\t\t\t\t\t\t" + (column.hasOwnProperty('code') ? column.hasOwnProperty('description') ? column.description : component_option.description : 'Posizione ' + index) + "\n\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t\t";
								
								if(column.hasOwnProperty('code')) {
									output += "\n\t\t\t\t\t\t\t<i class=\"fas fa-times fa-fw cursor-pointer builder-remove-component\"\n\t\t\t\t\t\t\tdata-row=\"" + i + "\" data-col=\"" + j + "\" title=\"Elimina componente\"></i>\n\t\t\t\t\t\t";
								}
								
								output += "\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t";
							}
							
							output += "\n\t\t\t\t\t\t<i class=\"fas fa-trash fa-fw cursor-pointer builder-remove-row\"\n\t\t\t\t\t\ttitle=\"Elimina riga\"></i>\n\t\t\t\t\t</div>\n\t\t\t\t";
						}
						
						grid.append(output);
					} else {
						grid.html("<h4 class=\"mt-0\">Crea una nuova riga per iniziare</h4>");
					} //aggiorno select posizione
					
					
					var options = '';
					options += "<option></option>";
					index = 0;
					
					for(var i in main.currentComponents) {
						var row = main.currentComponents[i];
						
						for(var j in row) {
							var col = row[j];
							index++;
							
							if(!col.hasOwnProperty('code')) {
								options += "<option value=\"" + index + "\">Posizione " + index + "</option>";
							}
						}
					}
					
					$('#component-position').html(options).trigger('change');
					main.onRenderGrid();
				}; //endregion
				//region EVENTI SCATENATI DALLA CLASSE
				
				/**
				 * Scatenato al completamento del rendering dei componenti nel form
				 */
				
				
				Composer.prototype.onRenderGrid = function() {
					var main = this;
					var rows = $('.builder-row'); //distruggo sortable se già instanziato
					
					if(rows.sortable('instance') !== undefined) {
						rows.sortable('destroy');
					} //attivo sortable alle colonne delle righe
					
					
					rows.sortable({
						items: "> .builder-column",
						cursor: 'move',
						opacity: 0.8,
						handle: '.builder-column',
						placeholder: 'builder-placeholder-row',
						helper: function helper(e, tr) {
							var $originals = tr.children();
							var $helper = tr.clone();
							$helper.children().each(function(index) {
								$(this).width($originals.eq(index).width());
								$(this).width($originals.eq(index).width());
							});
							return $helper;
						},
						start: function start(event, ui) {
							ui.placeholder.html('Rilascia qui');
						},
						update: function update() {
							//riga corrente
							var row = $(this); //indice riga corrente
							
							var rowIndex = Number(row.data('index')); //prendo gli indici correnti delle colonne
							
							var indexes = row.sortable('toArray', {
								attribute: 'data-index'
							}).map(function(x) {
								return Number(x);
							}); //riordino le righe dei componenti
							
							var form = [];
							indexes.forEach(function(item) {
								form.push(main.currentComponents[rowIndex][item]);
							}); //riaggiorno gli indici
							
							row.children('div').each(function(index) {
								$(this).removeAttr('data-index').attr('data-index', index);
							}); //salvo il nuovo oggetto
							
							main.currentComponents[rowIndex] = form;
						}
					});
				};
				/**
				 * Scatenato una volta impostata la variabile "availableComponents"
				 */
				
				
				Composer.prototype.onAvailableComponentsSet = function() {
					var main = this;
					main.tabs.forEach(function(value) {
						main.renderAvailableComponents($("#tab-" + value.id), main.availableComponents.filter(value.predicate));
					});
				};
				/**
				 * Scatenato al cambiamento del currentForm
				 */
				
				
				Composer.prototype.onCurrentFormChange = function() {
					return __awaiter(this, void 0, void 0, function() {
						var _a;
						
						return __generator(this, function(_b) {
							switch(_b.label) {
								case 0:
									_a = this;
									return [4
										/*yield*/
										, this.getFormComponents()];
								
								case 1:
									_a.currentComponents = _b.sent();
									return [2
										/*return*/
									];
							}
						});
					});
				};
				/**
				 * Scatenato una volta impostata la variabile "currentComponents"
				 */
				
				
				Composer.prototype.onCurrentComponentsSet = function() {
					this.renderGrid();
				};
				
				return Composer;
			}();
		
		exports.default = Composer; //endregion
		
		/*************************************************************************************************
		 DOCUMENTAZIONE CLASSE COMPOSER
		 Developed By @Lukasss93
		 Version: 2.0
		 *************************************************************************************************
		 
		 La seguente classe estende la classe Composer:
		 Es: export default class FormBuilder extends Composer [...]
		 
		 STEP 1 - configurare le rotte all'interno della classe
		 builder.routes={
    availableComponents:"A",
    formComponents:"B",
    saveForm:"C"
};
		 
		 STEP 2 - configurare le tab + filtri all'interno della classe
		 builder.tabs=[
		 {id:'presets',title:'Componenti preset', predicate:x=>x.preset===true},
		 {id:'unbounds',title:'Componenti liberi', predicate:x=>x.preset===false}
		 ];
		 
		 ************************************************************************************************
		 
		 STEP 1 - istanziare la classe estesa
		 FormBuilder builder = new FormBuilder();
		 
		 STEP 2 - chiamare il metodo init
		 builder.init();
		 
		 STEP 3 - impostare il current form - se non c'è il bisogno di impostarlo,
		 impostalo comunque con il valore 1 per avviare il caricamento della griglia
		 builder.currentForm=ID;
		 
		 STEP 4 - OPZIONALE - impostare isCurrentFormStatic a true
		 se non c'è il bisogno di impostare il currentForm
		 builder.isCurrentFormStatic=true
		 
		 */
		
		/***/
	}),
	
	/***/ "./src/resources/assets/js/modules/form_utils.js":
	/*!*******************************************************!*\
	  !*** ./src/resources/assets/js/modules/form_utils.js ***!
	  \*******************************************************/
	/*! no static exports found */
	/***/ (function(module, exports, __webpack_require__) {
		
		"use strict";
		
		/*
		 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
		 *  * Unauthorized copying of this file, via any medium is strictly prohibited
		 *  * Proprietary and confidential
		 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
		 *
		 */
		
		Object.defineProperty(exports, "__esModule", {
			value: true
		});
		
		var FormUtils =
			/** @class */
			function() {
				function FormUtils() {
				}
				
				/**
				 * Inizializza il componente select2 a nazione e città
				 * @param {number} country_id ID nazione-
				 * @param {number} city_id ID città
				 * @param {string} modal ID modal. Se presente
				 * @param {string} side Modalità: back|front
				 */
				
				
				FormUtils.setCountryAndCity = function(country_id, city_id, side, modal) {
					if(side === void 0) {
						side = 'back';
					}
					
					if(modal === void 0) {
						modal = null;
					}
					
					var baseURL = null,
						parentElement = $('body');
					
					if(modal !== null) {
						parentElement = $(modal);
					} // if
					
					
					switch(side) {
						case 'back':
							baseURL = admin_panel_url;
							break;
						
						case 'front':
							baseURL = app_url;
							break;
					} // switch
					
					
					var country = $(country_id),
						city = $(city_id),
						option = {
							placeholder: 'Seleziona una città',
							ajax: {
								url: baseURL + "/cities/0",
								dataType: 'json',
								data: function data(params) {
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
							url: baseURL + "/cities/" + country.val() + "/" + search_type,
							dataType: 'json',
							data: function data(params) {
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
					country.on('change', function() {
						var search_type = country.find(':selected').data('search');
						city.val(null);
						option = {
							placeholder: 'Seleziona una città',
							ajax: {
								//url: admin_panel_url + '/cities/' + country.val() + '/' + search_type,
								url: baseURL + "/cities/" + country.val() + "/" + search_type,
								dataType: 'json',
								data: function data(params) {
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
				};
				/**
				 * Imposta i valori ai componenti select2 a nazione e città
				 * @param {number} countryID ID nazione
				 * @param {number} cityID ID città
				 * @param {string} countrySelector Selettore input nazione
				 * @param {string} citySelector Selettore input città
				 */
				
				
				FormUtils.loadCountryAndCity = function(countryID, cityID, countrySelector, citySelector) {
					if(countrySelector === void 0) {
						countrySelector = '#country';
					}
					
					if(citySelector === void 0) {
						citySelector = '#city';
					}
					
					return new Promise(function(resolve, reject) {
						var country = $(countrySelector),
							city = $(citySelector); //nazione
						
						country.val(countryID).trigger('change'); //città
						
						$.ajax({
							type: 'GET',
							url: admin_panel_url + "/city/" + cityID
						}).then(function(data) {
							// create the option and append to Select2
							var option = new Option(data.text, data.id, true, true);
							city.append(option).trigger('change'); // manually trigger the `select2:select` event
							
							city.trigger({
								type: 'select2:select',
								params: {
									data: data
								}
							});
							resolve(true);
						}).fail(function(err) {
							reject(err);
						});
					});
				};
				/**
				 * Inizializza il componente select2 di tipo tag (usato per le skill)
				 * @param {number} skill_id ID input
				 * @param {string} action Azione select2: write|read
				 * @param {string} modal Selettore modal
				 * @param {boolean} hide_disabled
				 */
				
				
				FormUtils.setTags = function(skill_id, action, modal, hide_disabled) {
					if(modal === void 0) {
						modal = 'body';
					}
					
					if(hide_disabled === void 0) {
						hide_disabled = false;
					}
					
					var skill = $(skill_id),
						parentModal = $(modal),
						options = null;
					
					switch(action) {
						case 'write':
							options = {
								placeholder: 'Seleziona una skill',
								tags: true,
								multiple: true,
								dropdownParent: parentModal,
								tokenSeparators: [','],
								language: 'it',
								createSearchChoice: function createSearchChoice(term, data) {
									if($(data).filter(function() {
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
								createTag: function createTag(params) {
									return null;
								}
							};
							break;
					} // switch
					
					
					if(hide_disabled) {
						options['templateResult'] = function(data, container) {
							if(data.element && $(data.element).data("hide") == true) {
								$(container).addClass('select2hidden');
							}
							
							return data.text;
						};
					}
					
					skill.select2(options);
					skill.off('select2:select select2:unselect').on('select2:select select2:unselect', function() {
						var data = [];
						var current = $(this).select2('data');
						
						for(var key in current) {
							var item = current[key];
							
							if(item.id === item.text) {
								if(data.indexOf(item.id) !== -1) {
									$(item.element).remove();
								} else {
									data.push(item.id);
								} // if
								
							}
						}
					});
				};
				/**
				 * Imposta i valori di tags nel componente select2 di tipo tag
				 * @param {Array<number>} tags Array di tag
				 * @param {string} selector Selettore input
				 */
				
				
				FormUtils.loadTags = function(tags, selector) {
					if(selector === void 0) {
						selector = '#skills';
					}
					
					var obj = $(selector);
					obj.find('option:selected').removeAttr('selected');
					
					for(var key in tags) {
						var item = tags[key];
						obj.find("option[value=" + item + "]").prop('selected', true);
					}
					
					obj.trigger('change', -1);
				};
				/**
				 * Ottiene i valori da un input select2 di tipo tag
				 * @param {string} selector Selettore input
				 */
				
				
				FormUtils.getTags = function(selector) {
					return this.parseSelect2Data($(selector).select2('data'));
				};
				/**
				 * Ottiene tutti i campi dalla vista
				 * @param selector
				 * @param id
				 */
				
				
				FormUtils.retrieveAllInputs = function(selector, id) {
					if(selector === void 0) {
						selector = '.form-data';
					}
					
					if(id === void 0) {
						id = 'id';
					}
					
					var me = this; //prendo i valori degli elementi
					
					var obj = {};
					$(selector).each(function() {
						var current = $(this),
							value = null;
						
						if(current.is('input[type=file]')) {
							return null;
						} else if(current.is('input[type=checkbox]')) {
							value = current.prop('checked');
						} else if(current.is('select') && !current.hasClass('tag')) {
							value = current.find('option:selected').val();
						} else if(current.is('input[type=radio]')) {
							value = current.prop('checked');
						} else if(current.is('select') && current.hasClass('tag')) {
							value = me.parseSelect2Data(current.select2('data'));
						} else if(current.hasClass('money')) {
							if(current.val()) {
								value = current.maskMoney('unmasked')[0];
							} else {
								value = null;
							} // if
							
						} else if(current.hasClass('star-rank-element')) {
							value = current.raty('score');
							value = value.length == 0 ? 0 : value;
						} else {
							value = current.val();
						} // if
						
						
						obj[current.attr(id)] = value === null || value === undefined || typeof value === 'string' && value.length === 0 ? null : value;
					}); //restituisco l'array
					
					return obj;
				};
				/**
				 * Ottiene i valori di una select2 di tipo tag
				 * @param data
				 */
				
				
				FormUtils.parseSelect2Data = function(data) {
					var output = [];
					
					for(var key in data) {
						var manual = $(data[key].element).data('select2-tag');
						manual = manual !== undefined;
						var item = {
							id: manual ? null : data[key].id * 1,
							text: data[key].text.trim()
						};
						output.push(item);
					}
					
					return output;
				};
				/**
				 * Controlla se un modal è aperto
				 * @param modal
				 */
				
				
				FormUtils.isModalOpen = function(modal) {
					var modalIsShown = ($(modal).data('bs.modal') || {})._isShown;
					
					return !(typeof modalIsShown === 'undefined' || !modalIsShown);
				};
				/**
				 * Ritarda l'esecuzione dello script per un tempo definito in millisecondi
				 * @param time Millisecondi
				 */
				
				
				FormUtils.delay = function(time) {
					return new Promise(function(resolve) {
						setTimeout(function() {
							resolve();
						}, time);
					});
				};
				/**
				 * Controlla se un array è uguale ad un altro (ignorando posizioni diverse)
				 * @param a
				 * @param b
				 */
				
				
				FormUtils.arraysEqual = function(a, b) {
					if(a === b) return true;
					if(a == null || b == null) return false;
					if(a.length != b.length) return false;
					a.sort();
					b.sort();
					
					for(var i = 0; i < a.length; ++i) {
						if(a[i] !== b[i]) return false;
					}
					
					return true;
				};
				/**
				 * Configura un input personalizzato per gli input file
				 * @param buttonSelector
				 * @param inputSelector
				 * @param textSelector
				 * @param onChange
				 */
				
				
				FormUtils.setInputFile = function(buttonSelector, inputSelector, textSelector, onChange) {
					if(onChange === void 0) {
						onChange = null;
					} //click bottone custom => trigger input file
					
					
					$(buttonSelector).on('click', function() {
						$(inputSelector).trigger('click');
					}); //alla selezione di un nuovo file => trigger evento
					
					$(inputSelector).on('change', function(e) {
						$(textSelector).val(e.target.files[0].name);
						typeof onChange === 'function' && onChange();
					});
				};
				/**
				 * Configura un input personalizzato per gli input file (solo avatar)
				 * @param buttonSelector
				 * @param inputSelector
				 * @param imageSelector
				 * @param onChange
				 */
				
				
				FormUtils.setInputAvatar = function(buttonSelector, inputSelector, imageSelector, onChange) {
					if(onChange === void 0) {
						onChange = null;
					}
					
					var filereader = new FileReader(); //click bottone custom => trigger input file
					
					$(buttonSelector).on('click', function() {
						$(inputSelector).trigger('click');
					}); //alla selezione di un nuovo file => trigger evento
					
					$(inputSelector).on('change', function(e) {
						filereader.readAsDataURL(e.target.files[0]);
					});
					
					filereader.onload = function(e) {
						var avatar = $(imageSelector),
							avatar_width = avatar.width();
						avatar.prop('src', e.target.result);
						avatar.height(avatar_width);
						typeof onChange === 'function' && onChange();
					};
				};
				/**
				 * Imposta un valore nell'input desiderato se l'input è vuoto
				 * @param selector
				 * @param value
				 * @param datepicker
				 */
				
				
				FormUtils.setIfNull = function(selector, value, datepicker) {
					if(datepicker === void 0) {
						datepicker = false;
					}
					
					var input = $(selector);
					
					if(String(input.val()).length == 0) {
						if(datepicker) {
							input.datepicker('update', value);
						} else {
							input.val(value);
						}
					}
				};
				/**
				 * Ottiene tutti i campi dalla vista in FormData
				 * @param selector
				 * @param id
				 */
				
				
				FormUtils.getInputFormDataJson = function(selector, id) {
					if(selector === void 0) {
						selector = '.form-data';
					}
					
					if(id === void 0) {
						id = 'id';
					} //ottengo i dati di input file
					
					
					var formdata = new FormData();
					var values = [];
					$(selector).each(function() {
						var current = $(this),
							item = {
								id: current.prop(id),
								value: null
							};
						
						if(current.is('input[type=file]')) {
							formdata.append(current.prop(id), current[0].files.length > 0 ? current[0].files[0] : '');
						} else if(current.is('input[type=checkbox]')) {
							item.value = current.prop('checked');
							values.push(item);
						} else if(current.is('select') && !current.hasClass('tag')) {
							item.value = current.find('option:selected').val();
							item.value = item.value === undefined ? null : item.value;
							values.push(item);
						} else if(current.is('select') && current.hasClass('tag')) {
							item.value = FormUtils.parseSelect2Data(current.select2('data'));
							values.push(item);
						} else if(current.hasClass('money')) {
							item.value = current.val() ? current.maskMoney('unmasked')[0] : null;
							values.push(item);
						} else {
							item.value = String(current.val()).length > 0 ? current.val() : null;
							values.push(item);
						}
					});
					formdata.append('data', JSON.stringify(values)); //restituisco form data
					
					return formdata;
				};
				/**
				 * Converte un oggetto in un FormData
				 * @param {object} obj
				 * @returns {FormData}
				 */
				
				
				FormUtils.objectToFormData = function(obj) {
					var formdata = new FormData();
					formdata.append('data', JSON.stringify(obj));
					return formdata;
				};
				/**
				 * Invia una notifica di errore da un xhr (ajax)
				 * @param xhr
				 */
				
				
				FormUtils.sendNotifications = function(xhr) {
					if(xhr.responseText === undefined || xhr.responseText === null) {
						return;
					}
					
					var body = $('body'),
						response = JSON.parse(xhr.responseText),
						errors = response.errors;
					
					if(response.exception !== undefined) {
						//@ts-ignore
						body.pgNotification({
							"style": "simple",
							"message": "\n\t\t\t\t\t<b>Eccezione: </b> " + response.exception + "<br>\n\t\t\t\t\t<b>Messaggio: </b> " + response.message + "<br>\n\t\t\t\t\t<b>File: </b> " + response.file + "<br>\n\t\t\t\t\t<b>Line: </b> " + response.line,
							"showClose": true,
							"type": "danger"
						}).show();
					} else if(errors === undefined) {
						//@ts-ignore
						body.pgNotification({
							"style": "simple",
							"message": "<span><strong>Attenzione: </strong></span> " + response.message,
							"showClose": true,
							"type": "danger"
						}).show();
					} else {
						for(var err in errors) {
							var opt = {
								"style": "simple",
								"message": '<span><strong>Attenzione!</strong></span><br>' + errors[err].join('<br>'),
								"showClose": true,
								"type": "danger"
							}; //@ts-ignore
							
							body.pgNotification(opt).show();
						}
					}
				};
				/**
				 * Effettua lo stip dei tag HTML
				 * @param data
				 */
				
				
				FormUtils.stripHTML = function(data) {
					var tmp = document.createElement('div');
					tmp.innerHTML = data;
					return tmp.textContent || tmp.innerText || "";
				};
				/**
				 * Maschera input con il template orario 24h
				 * @param {string} selector
				 */
				
				
				FormUtils.maskTime = function(selector) {
					var maskBehavior = function maskBehavior(val) {
						var valA = val.split(":");
						return parseInt(valA[0]) > 19 ? "HZ:M0" : "H0:M0";
					};
					
					$(selector).mask(maskBehavior, {
						onKeyPress: function onKeyPress(val, e, field, options) {
							field.mask(maskBehavior.apply({}, arguments), options);
						},
						translation: {
							'H': {
								pattern: /[0-2]/,
								optional: false
							},
							'Z': {
								pattern: /[0-3]/,
								optional: false
							},
							'M': {
								pattern: /[0-5]/,
								optional: false
							}
						}
					});
				};
				
				return FormUtils;
			}();
		
		exports.default = FormUtils;
		
		/***/
	}),
	
	/***/ "./src/resources/assets/js/modules/modern-gui.js":
	/*!*******************************************************!*\
	  !*** ./src/resources/assets/js/modules/modern-gui.js ***!
	  \*******************************************************/
	/*! no static exports found */
	/***/ (function(module, exports, __webpack_require__) {
		
		"use strict";
		
		/*
		 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
		 *  * Unauthorized copying of this file, via any medium is strictly prohibited
		 *  * Proprietary and confidential
		 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
		 *
		 */
		
		Object.defineProperty(exports, "__esModule", {
			value: true
		});
		
		var ModernGui =
			/** @class */
			function() {
				function ModernGui() {
				}
				
				/**
				 * Visualizza un'interfaccia di alert
				 * @param {string} message
				 * @returns {Promise<void>}
				 */
				
				
				ModernGui.alert = function(message) {
					var main = this;
					return new Promise(function(resolve) {
						//imposto messaggio
						main.modernGUI.malert.message.html(message); //assegno evento click bottone "ok"
						
						main.modernGUI.malert.ok.off().on('click', function() {
							main.modernGUI.malert.gui.modal('hide');
							resolve();
						}); //mostro gui
						
						main.modernGUI.malert.gui.modal('show');
					});
				};
				/**
				 * Visualizza un'interfaccia di conferma
				 * @param {string} message
				 * @returns {Promise<boolean>}
				 */
				
				
				ModernGui.confirm = function(message) {
					var main = this;
					return new Promise(function(resolve) {
						//imposto il messaggio
						main.modernGUI.mconfirm.message.html(message); //evento bottone "ok"
						
						main.modernGUI.mconfirm.ok.off().on('click', function() {
							main.modernGUI.mconfirm.gui.modal('hide');
							resolve(true);
						}); //evento bottone "annulla"
						
						main.modernGUI.mconfirm.cancel.off().on('click', function() {
							main.modernGUI.mconfirm.gui.modal('hide');
							resolve(false);
						}); //mostro la gui
						
						main.modernGUI.mconfirm.gui.modal('show');
					});
				};
				/**
				 * Visualizza un'interfaccia con immissione di testo
				 * @param {string} message
				 * @returns {Promise<{result: boolean, text: string}>}
				 */
				
				
				ModernGui.prompt = function(message) {
					var main = this;
					return new Promise(function(resolve) {
						//imposto il messaggio
						main.modernGUI.mprompt.message.html(message); //evento bottone "ok"
						
						main.modernGUI.mprompt.ok.off().on('click', function() {
							main.modernGUI.mprompt.gui.modal('hide');
							resolve({
								result: true,
								text: main.modernGUI.mprompt.input.val().toString()
							});
							main.modernGUI.mprompt.input.val('');
						}); //evento bottone "annulla"
						
						main.modernGUI.mprompt.cancel.off().on('click', function() {
							main.modernGUI.mprompt.gui.modal('hide');
							resolve({
								result: false,
								text: main.modernGUI.mprompt.input.val().toString()
							});
							main.modernGUI.mprompt.input.val('');
						}); //evento input al click dei tasti
						
						main.modernGUI.mprompt.input.off().on('keyup', function(e) {
							if(e.keyCode === 13) {
								main.modernGUI.mprompt.gui.modal('hide');
								resolve({
									result: true,
									text: main.modernGUI.mprompt.input.val().toString()
								});
								main.modernGUI.mprompt.input.val('');
							}
						}); //evento alla visualizzazione della gui
						
						main.modernGUI.mprompt.gui.on('shown.bs.modal', function() {
							main.modernGUI.mprompt.input.focus();
						}); //mostro la gui
						
						main.modernGUI.mprompt.gui.modal('show');
					});
				};
				/**
				 * Visualizza un'interfaccia di caricamento con eventuale messaggio personalizzato
				 * @param {boolean} status
				 * @param {string} message
				 */
				
				
				ModernGui.loading = function(status, message) {
					if(status === void 0) {
						status = true;
					}
					
					if(message === void 0) {
						message = 'Caricamento dei dati in corso...';
					}
					
					var main = this; //imposto delay e mostro/nascondo gui
					
					setTimeout(function() {
						if(status) {
							//inserisco messaggio
							main.modernGUI.mloading.message.html(message);
							main.modernGUI.mloading.gui.modal('show');
						} else {
							main.modernGUI.mloading.gui.modal('hide');
						}
					}, status ? 0 : 500);
				};
				
				ModernGui.modernGUI = {
					mloading: {
						gui: $('#mloading-gui'),
						message: $('#mloading-message')
					},
					malert: {
						gui: $('#malert-gui'),
						message: $('#malert-message'),
						ok: $('#malert-ok')
					},
					mconfirm: {
						gui: $('#mconfirm-gui'),
						message: $('#mconfirm-message'),
						ok: $('#mconfirm-ok'),
						cancel: $('#mconfirm-cancel')
					},
					mprompt: {
						gui: $('#mprompt-gui'),
						message: $('#mprompt-message'),
						input: $('#mprompt-input'),
						ok: $('#mprompt-ok'),
						cancel: $('#mprompt-cancel')
					}
				};
				return ModernGui;
			}();
		
		exports.default = ModernGui;
		
		/***/
	}),
	
	/***/ "./src/resources/assets/js/modules/notify.js":
	/*!***************************************************!*\
	  !*** ./src/resources/assets/js/modules/notify.js ***!
	  \***************************************************/
	/*! no static exports found */
	/***/ (function(module, exports, __webpack_require__) {
		
		"use strict";
		
		/*
		 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
		 *  * Unauthorized copying of this file, via any medium is strictly prohibited
		 *  * Proprietary and confidential
		 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
		 *
		 */
		
		Object.defineProperty(exports, "__esModule", {
			value: true
		});
		
		var Notify =
			/** @class */
			function() {
				function Notify() {
				}
				
				Notify.send = function(options) {
					//@ts-ignore
					$('body').pgNotification(options).show();
				};
				
				Notify.info = function(message) {
					this.send({
						type: 'info',
						message: message
					});
				};
				
				Notify.warning = function(message) {
					this.send({
						type: 'warning',
						message: message
					});
				};
				
				Notify.success = function(message) {
					this.send({
						type: 'success',
						message: message
					});
				};
				
				Notify.danger = function(message) {
					this.send({
						type: 'danger',
						message: message
					});
				};
				
				return Notify;
			}();
		
		exports.default = Notify;
		
		/***/
	}),
	
	/***/ "./src/resources/assets/js/modules/utils.js":
	/*!**************************************************!*\
	  !*** ./src/resources/assets/js/modules/utils.js ***!
	  \**************************************************/
	/*! no static exports found */
	/***/ (function(module, exports, __webpack_require__) {
		
		"use strict";
		
		/*
		 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
		 *  * Unauthorized copying of this file, via any medium is strictly prohibited
		 *  * Proprietary and confidential
		 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
		 *
		 */
		
		function _typeof(obj) {
			if(typeof Symbol === "function" && typeof Symbol.iterator === "symbol") {
				_typeof = function _typeof(obj) {
					return typeof obj;
				};
			} else {
				_typeof = function _typeof(obj) {
					return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
				};
			}
			return _typeof(obj);
		}
		
		Object.defineProperty(exports, "__esModule", {
			value: true
		});
		
		var Utils =
			/** @class */
			function() {
				function Utils() {
				}
				
				/**
				 * Controlla se un variabile è vuota
				 * @param variable
				 * @param {boolean} strict
				 * @returns {boolean}
				 */
				
				
				Utils.empty = function(variable, strict) {
					if(strict === void 0) {
						strict = false;
					}
					
					if(variable === "" || variable === null || variable === undefined) {
						return true;
					}
					
					var count = 0;
					
					if(_typeof(variable) === "object") {
						for(var key in variable) {
							count++;
						}
						
						if(count == 0) {
							return true;
						}
					}
					
					if(strict) {
						if(variable === 0 || variable === "0" || variable === false) {
							return true;
						}
					}
					
					return false;
				};
				/**
				 * Genera un uuid randomico
				 * @returns {string}
				 */
				
				
				Utils.uuid = function() {
					return Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
				};
				/**
				 * Controlla se una stringa si trova dentro un'array di stringhe
				 * @param {string} value
				 * @param {Array<string>} array
				 * @returns {boolean}
				 */
				
				
				Utils.in_array = function(value, array) {
					return array.indexOf(value) !== -1;
				};
				/**
				 * Esegue il codice nella callback al click dei bottoni CTRL + Tasto Custom (Default: ArrowRight)
				 * @param {() => void} onKeyUp
				 * @param {string} keyCode
				 * @param debugInfo
				 */
				
				
				Utils.debug = function(onKeyUp, keyCode, debugInfo) {
					if(keyCode === void 0) {
						keyCode = 'ArrowRight';
					}
					
					if(debugInfo === void 0) {
						debugInfo = true;
					}
					
					$('body').off('keyup.debug.' + keyCode).on('keyup.debug.' + keyCode, function(e) {
						if(e.ctrlKey && e.key == keyCode) {
							if(debugInfo) {
								console.log('=============DEBUG============');
							}
							
							onKeyUp();
							
							if(debugInfo) {
								console.log('==============================');
							}
						}
					});
				};
				/**
				 * Converte i byte in un formato più leggibile
				 * @returns {any}
				 * @param bytes
				 */
				
				
				Utils.bytes2str = function(bytes) {
					if(bytes >= 1073741824) {
						return this.round(bytes / 1073741824, 2) + ' GB';
					} else if(bytes >= 1048576) {
						return this.round(bytes / 1048576, 2) + ' MB';
					} else if(bytes >= 1024) {
						return this.round(bytes / 1024, 2) + ' KB';
					} else if(bytes > 1) {
						return bytes + ' bytes';
					} else if(bytes == 1) {
						return bytes + ' byte';
					} else {
						return '0 bytes';
					}
				};
				/**
				 * Approssima un numero decimale
				 * @param {number} number
				 * @param {number} decimal
				 * @returns {number}
				 */
				
				
				Utils.round = function(number, decimal) {
					var onumber = number + "e+" + decimal;
					return +(Math.round(Number(onumber)) + "e-" + decimal);
				};
				/**
				 * Inserisce del testo in un input element nella posizione del cursore
				 * @param {string} inputID
				 * @param {string} text
				 */
				
				
				Utils.insertAtCaret = function(inputID, text) {
					var txtarea = document.getElementById(inputID);
					
					if(!txtarea) {
						return;
					}
					
					var scrollPos = txtarea.scrollTop;
					var strPos = 0; //@ts-ignore
					
					var br = txtarea.selectionStart || txtarea.selectionStart == '0' ? "ff" : document.selection ? "ie" : false;
					
					if(br == "ie") {
						txtarea.focus(); //@ts-ignore
						
						var range = document.selection.createRange();
						range.moveStart('character', -txtarea.value.length);
						strPos = range.text.length;
					} else if(br == "ff") {
						strPos = txtarea.selectionStart;
					}
					
					var front = txtarea.value.substring(0, strPos);
					var back = txtarea.value.substring(strPos, txtarea.value.length);
					txtarea.value = front + text + back;
					strPos = strPos + text.length;
					
					if(br == "ie") {
						txtarea.focus(); //@ts-ignore
						
						var ieRange = document.selection.createRange();
						ieRange.moveStart('character', -txtarea.value.length);
						ieRange.moveStart('character', strPos);
						ieRange.moveEnd('character', 0);
						ieRange.select();
					} else if(br == "ff") {
						txtarea.selectionStart = strPos;
						txtarea.selectionEnd = strPos;
						txtarea.focus();
					}
					
					txtarea.scrollTop = scrollPos;
				};
				/**
				 * Costruisce i parametri query per un url
				 * @param data
				 * @returns {string}
				 */
				
				
				Utils.buildQueryUrl = function(data) {
					var ret = [];
					
					for(var d in data) {
						ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
					}
					
					if(ret.length > 0) {
						return '?' + ret.join('&');
					}
					
					return '';
				};
				
				return Utils;
			}();
		
		exports.default = Utils;
		
		/***/
	}),
	
	/***/ "./src/resources/assets/js/modules/widgets/widgets_edit.js":
	/*!*****************************************************************!*\
	  !*** ./src/resources/assets/js/modules/widgets/widgets_edit.js ***!
	  \*****************************************************************/
	/*! no static exports found */
	/***/ (function(module, exports, __webpack_require__) {
		
		"use strict";
		
		
		var __extends = this && this.__extends || function() {
			var _extendStatics = function extendStatics(d, b) {
				_extendStatics = Object.setPrototypeOf || {
					__proto__: []
				} instanceof Array && function(d, b) {
					d.__proto__ = b;
				} || function(d, b) {
					for(var p in b) {
						if(b.hasOwnProperty(p)) d[p] = b[p];
					}
				};
				
				return _extendStatics(d, b);
			};
			
			return function(d, b) {
				_extendStatics(d, b);
				
				function __() {
					this.constructor = d;
				}
				
				d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
			};
		}();
		
		Object.defineProperty(exports, "__esModule", {
			value: true
		});
		
		var composer_1 = __webpack_require__(/*! ../composer */ "./src/resources/assets/js/modules/composer.js");
		
		var WidgetsEdit =
			/** @class */
			function(_super) {
				__extends(WidgetsEdit, _super);
				
				function WidgetsEdit(role) {
					var _this = _super.call(this) || this;
					
					_this.tabs = [{
						id: 'Widgets',
						title: 'Widgets',
						predicate: function predicate(x) {
							return true;
						}
					}];
					
					_this.setRole(role);
					
					return _this;
				}
				
				WidgetsEdit.prototype.setRole = function(id) {
					var main = this;
					main.routes = {
						availableComponents: "widgets/edit-load-all",
						formComponents: "widgets/load-rows/" + id,
						saveForm: "widgets/save/" + id
					};
				};
				
				return WidgetsEdit;
			}(composer_1.default);
		
		exports.default = WidgetsEdit;
		
		/***/
	}),
	
	/***/ 15:
	/*!**************************************************************************!*\
	  !*** multi ./src/resources/assets/js/components/widgets/widgets-edit.ts ***!
	  \**************************************************************************/
	/*! no static exports found */
	/***/ (function(module, exports, __webpack_require__) {
		
		module.exports = __webpack_require__(/*! C:\Users\roberto.ferro\PhpstormProjects\ikpanel\packages\ikdev\ikpanel\src\resources\assets\js\components\widgets\widgets-edit.ts */"./src/resources/assets/js/components/widgets/widgets-edit.ts");
		
		
		/***/
	})
	
	/******/
});
//# sourceMappingURL=widgets-edit.js.map
