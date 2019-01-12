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
	return __webpack_require__(__webpack_require__.s = 1);
	/******/
})
/************************************************************************/
/******/({
	
	/***/ "./packages/ikdev/ikpanel/src/Modules/blog/resources/assets/js/components/categories/edit.ts":
	/*!***************************************************************************************************!*\
	  !*** ./packages/ikdev/ikpanel/src/Modules/blog/resources/assets/js/components/categories/edit.ts ***!
	  \***************************************************************************************************/
	/*! no static exports found */
	/***/ (function(module, exports, __webpack_require__) {
		
		"use strict";
		
		var __awaiter = (this && this.__awaiter) || function(thisArg, _arguments, P, generator) {
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
		var __generator = (this && this.__generator) || function(thisArg, body) {
			var _ = {
				label: 0, sent: function() {
					if(t[0] & 1) throw t[1];
					return t[1];
				}, trys: [], ops: []
			}, f, y, t, g;
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
				while(_) try {
					if(f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
					if(y = 0, t) op = [op[0] & 2, t.value];
					switch(op[0]) {
						case 0:
						case 1:
							t = op;
							break;
						case 4:
							_.label++;
							return {value: op[1], done: false};
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
							if(op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) {
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
				if(op[0] & 5) throw op[1];
				return {value: op[0] ? op[1] : void 0, done: true};
			}
		};
		Object.defineProperty(exports, "__esModule", {value: true});
		var form_utils_1 = __webpack_require__(/*! ../../../../../../../../../../../resources/assets/js/modules/form_utils */ "./resources/assets/js/modules/form_utils.js");
		var modern_gui_1 = __webpack_require__(/*! ../../../../../../../../../../../resources/assets/js/modules/modern-gui */ "./resources/assets/js/modules/modern-gui.js");
		$(function() {
			var body = $('body');
			$('#categoryDescription').ckeditor(function() {
			}, {
				language: 'it',
				height: 500
			});
			body.on('click', '.action-save', function() {
				var object = form_utils_1.default.retrieveAllInputs();
				$.ajax({
					type: 'POST',
					url: admin_panel_url + "/mod/blog/categories/edit",
					data: object,
					beforeSend: function() {
						modern_gui_1.default.loading(true, 'Modifica categoria in corso');
					},
					success: function() {
						location.reload();
					},
					complete: function() {
						modern_gui_1.default.loading(false);
					}
				});
			});
			body.on('click', '#deleteCategory', function() {
				return __awaiter(this, void 0, void 0, function() {
					return __generator(this, function(_a) {
						switch(_a.label) {
							case 0:
								return [4 /*yield*/, modern_gui_1.default.confirm('Sei sicuro di voler eliminare questa catagoria?')];
							case 1:
								if(_a.sent()) {
									$.ajax({
										type: 'DELETE',
										url: admin_panel_url + "/mod/blog/categories/delete/" + $(this).data('id'),
										beforeSend: function() {
											modern_gui_1.default.loading(true, 'Eliminazione categoria in corso...');
										},
										success: function() {
											location.href = admin_panel_url + "/mod/blog/categories/show";
										},
										complete: function() {
											modern_gui_1.default.loading(false);
										}
									});
								} // if
								return [2 /*return*/];
						}
					});
				});
			});
		});
		
		
		/***/
	}),
	
	/***/ "./resources/assets/js/modules/form_utils.js":
	/*!***************************************************!*\
	  !*** ./resources/assets/js/modules/form_utils.js ***!
	  \***************************************************/
	/*! no static exports found */
	/***/ (function(module, exports, __webpack_require__) {
		
		"use strict";
		
		
		Object.defineProperty(exports, "__esModule", {
			value: true
		});
		
		var FormUtils =
			/** @class */
			function() {
				function FormUtils() {
				}
				
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
						} else if(current.is('select') && current.hasClass('tag')) {
							value = me.parseSelect2Data(current.select2('data'));
						} else if(current.hasClass('money')) {
							if(current.val()) {
								value = current.maskMoney('unmasked')[0];
							} else {
								value = null;
							} // if
							
						} else {
							value = current.val();
						} // if
						
						
						obj[current.attr(id)] = value === null || typeof value === 'string' && value.length === 0 ? null : value;
					}); //restituisco l'array
					
					return obj;
				};
				
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
				
				FormUtils.isModalOpen = function(modal) {
					var modalIsShown = ($(modal).data('bs.modal') || {})._isShown;
					
					return !(typeof modalIsShown === 'undefined' || !modalIsShown);
				};
				
				FormUtils.delay = function(time) {
					return new Promise(function(resolve) {
						setTimeout(function() {
							resolve();
						}, time);
					});
				};
				
				return FormUtils;
			}();
		
		exports.default = FormUtils;
		
		/***/
	}),
	
	/***/ "./resources/assets/js/modules/modern-gui.js":
	/*!***************************************************!*\
	  !*** ./resources/assets/js/modules/modern-gui.js ***!
	  \***************************************************/
	/*! no static exports found */
	/***/ (function(module, exports, __webpack_require__) {
		
		"use strict";
		
		
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
	
	/***/ 1:
	/*!*********************************************************************************************************!*\
	  !*** multi ./packages/ikdev/ikpanel/src/Modules/blog/resources/assets/js/components/categories/edit.ts ***!
	  \*********************************************************************************************************/
	/*! no static exports found */
	/***/ (function(module, exports, __webpack_require__) {
		
		module.exports = __webpack_require__(/*! C:\Users\roberto.ferro\PhpstormProjects\ikpanel-full\packages\ikdev\ikpanel\src\Modules\blog\resources\assets\js\components\categories\edit.ts */"./packages/ikdev/ikpanel/src/Modules/blog/resources/assets/js/components/categories/edit.ts");
		
		
		/***/
	})
	
	/******/
});