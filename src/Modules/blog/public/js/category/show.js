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
	return __webpack_require__(__webpack_require__.s = 0);
	/******/
})
/************************************************************************/
/******/({
	
	/***/ "./node_modules/events/events.js":
	/*!***************************************!*\
	  !*** ./node_modules/events/events.js ***!
	  \***************************************/
	/*! no static exports found */
	/***/ (function(module, exports) {

// Copyright Joyent, Inc. and other Node contributors.
//
// Permission is hereby granted, free of charge, to any person obtaining a
// copy of this software and associated documentation files (the
// "Software"), to deal in the Software without restriction, including
// without limitation the rights to use, copy, modify, merge, publish,
// distribute, sublicense, and/or sell copies of the Software, and to permit
// persons to whom the Software is furnished to do so, subject to the
// following conditions:
//
// The above copyright notice and this permission notice shall be included
// in all copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
// OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
// MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN
// NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
// DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
// OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE
// USE OR OTHER DEALINGS IN THE SOFTWARE.
		
		function EventEmitter() {
			this._events = this._events || {};
			this._maxListeners = this._maxListeners || undefined;
		}
		
		module.exports = EventEmitter;

// Backwards-compat with node 0.10.x
		EventEmitter.EventEmitter = EventEmitter;
		
		EventEmitter.prototype._events = undefined;
		EventEmitter.prototype._maxListeners = undefined;

// By default EventEmitters will print a warning if more than 10 listeners are
// added to it. This is a useful default which helps finding memory leaks.
		EventEmitter.defaultMaxListeners = 10;

// Obviously not all Emitters should be limited to 10. This function allows
// that to be increased. Set to zero for unlimited.
		EventEmitter.prototype.setMaxListeners = function(n) {
			if(!isNumber(n) || n < 0 || isNaN(n))
				throw TypeError('n must be a positive number');
			this._maxListeners = n;
			return this;
		};
		
		EventEmitter.prototype.emit = function(type) {
			var er, handler, len, args, i, listeners;
			
			if(!this._events)
				this._events = {};
			
			// If there is no 'error' event listener then throw.
			if(type === 'error') {
				if(!this._events.error ||
					(isObject(this._events.error) && !this._events.error.length)) {
					er = arguments[1];
					if(er instanceof Error) {
						throw er; // Unhandled 'error' event
					} else {
						// At least give some kind of context to the user
						var err = new Error('Uncaught, unspecified "error" event. (' + er + ')');
						err.context = er;
						throw err;
					}
				}
			}
			
			handler = this._events[type];
			
			if(isUndefined(handler))
				return false;
			
			if(isFunction(handler)) {
				switch(arguments.length) {
					// fast cases
					case 1:
						handler.call(this);
						break;
					case 2:
						handler.call(this, arguments[1]);
						break;
					case 3:
						handler.call(this, arguments[1], arguments[2]);
						break;
					// slower
					default:
						args = Array.prototype.slice.call(arguments, 1);
						handler.apply(this, args);
				}
			} else if(isObject(handler)) {
				args = Array.prototype.slice.call(arguments, 1);
				listeners = handler.slice();
				len = listeners.length;
				for(i = 0; i < len; i++)
					listeners[i].apply(this, args);
			}
			
			return true;
		};
		
		EventEmitter.prototype.addListener = function(type, listener) {
			var m;
			
			if(!isFunction(listener))
				throw TypeError('listener must be a function');
			
			if(!this._events)
				this._events = {};
			
			// To avoid recursion in the case that type === "newListener"! Before
			// adding it to the listeners, first emit "newListener".
			if(this._events.newListener)
				this.emit('newListener', type,
					isFunction(listener.listener) ?
						listener.listener : listener);
			
			if(!this._events[type])
			// Optimize the case of one listener. Don't need the extra array object.
				this._events[type] = listener;
			else if(isObject(this._events[type]))
			// If we've already got an array, just append.
				this._events[type].push(listener);
			else
			// Adding the second element, need to change to array.
				this._events[type] = [this._events[type], listener];
			
			// Check for listener leak
			if(isObject(this._events[type]) && !this._events[type].warned) {
				if(!isUndefined(this._maxListeners)) {
					m = this._maxListeners;
				} else {
					m = EventEmitter.defaultMaxListeners;
				}
				
				if(m && m > 0 && this._events[type].length > m) {
					this._events[type].warned = true;
					console.error('(node) warning: possible EventEmitter memory ' +
						'leak detected. %d listeners added. ' +
						'Use emitter.setMaxListeners() to increase limit.',
						this._events[type].length);
					if(typeof console.trace === 'function') {
						// not supported in IE 10
						console.trace();
					}
				}
			}
			
			return this;
		};
		
		EventEmitter.prototype.on = EventEmitter.prototype.addListener;
		
		EventEmitter.prototype.once = function(type, listener) {
			if(!isFunction(listener))
				throw TypeError('listener must be a function');
			
			var fired = false;
			
			function g() {
				this.removeListener(type, g);
				
				if(!fired) {
					fired = true;
					listener.apply(this, arguments);
				}
			}
			
			g.listener = listener;
			this.on(type, g);
			
			return this;
		};

// emits a 'removeListener' event iff the listener was removed
		EventEmitter.prototype.removeListener = function(type, listener) {
			var list, position, length, i;
			
			if(!isFunction(listener))
				throw TypeError('listener must be a function');
			
			if(!this._events || !this._events[type])
				return this;
			
			list = this._events[type];
			length = list.length;
			position = -1;
			
			if(list === listener ||
				(isFunction(list.listener) && list.listener === listener)) {
				delete this._events[type];
				if(this._events.removeListener)
					this.emit('removeListener', type, listener);
				
			} else if(isObject(list)) {
				for(i = length; i-- > 0;) {
					if(list[i] === listener ||
						(list[i].listener && list[i].listener === listener)) {
						position = i;
						break;
					}
				}
				
				if(position < 0)
					return this;
				
				if(list.length === 1) {
					list.length = 0;
					delete this._events[type];
				} else {
					list.splice(position, 1);
				}
				
				if(this._events.removeListener)
					this.emit('removeListener', type, listener);
			}
			
			return this;
		};
		
		EventEmitter.prototype.removeAllListeners = function(type) {
			var key, listeners;
			
			if(!this._events)
				return this;
			
			// not listening for removeListener, no need to emit
			if(!this._events.removeListener) {
				if(arguments.length === 0)
					this._events = {};
				else if(this._events[type])
					delete this._events[type];
				return this;
			}
			
			// emit removeListener for all listeners on all events
			if(arguments.length === 0) {
				for(key in this._events) {
					if(key === 'removeListener') continue;
					this.removeAllListeners(key);
				}
				this.removeAllListeners('removeListener');
				this._events = {};
				return this;
			}
			
			listeners = this._events[type];
			
			if(isFunction(listeners)) {
				this.removeListener(type, listeners);
			} else if(listeners) {
				// LIFO order
				while(listeners.length)
					this.removeListener(type, listeners[listeners.length - 1]);
			}
			delete this._events[type];
			
			return this;
		};
		
		EventEmitter.prototype.listeners = function(type) {
			var ret;
			if(!this._events || !this._events[type])
				ret = [];
			else if(isFunction(this._events[type]))
				ret = [this._events[type]];
			else
				ret = this._events[type].slice();
			return ret;
		};
		
		EventEmitter.prototype.listenerCount = function(type) {
			if(this._events) {
				var evlistener = this._events[type];
				
				if(isFunction(evlistener))
					return 1;
				else if(evlistener)
					return evlistener.length;
			}
			return 0;
		};
		
		EventEmitter.listenerCount = function(emitter, type) {
			return emitter.listenerCount(type);
		};
		
		function isFunction(arg) {
			return typeof arg === 'function';
		}
		
		function isNumber(arg) {
			return typeof arg === 'number';
		}
		
		function isObject(arg) {
			return typeof arg === 'object' && arg !== null;
		}
		
		function isUndefined(arg) {
			return arg === void 0;
		}
		
		
		/***/
	}),
	
	/***/ "./packages/ikdev/ikpanel/src/Modules/blog/resources/assets/js/components/categories/show.ts":
	/*!***************************************************************************************************!*\
	  !*** ./packages/ikdev/ikpanel/src/Modules/blog/resources/assets/js/components/categories/show.ts ***!
	  \***************************************************************************************************/
	/*! no static exports found */
	/***/ (function(module, exports, __webpack_require__) {
		
		"use strict";
		
		Object.defineProperty(exports, "__esModule", {value: true});
		var simple_gui_1 = __webpack_require__(/*! ../../../../../../../resources/assets/js/modules/simple-gui */ "./packages/ikdev/ikpanel/src/resources/assets/js/modules/simple-gui.js");
		var SGui = new simple_gui_1.default();
// General settings
		SGui.table = '#blogCategoryTable';
		SGui.searchFilter = '#search-filter';
		SGui.statusFilter = '#status-filter';
		SGui.filterUrlPrefix = 'mod/blog/categories';
		SGui.itemInTable = -1;
		SGui.resultContainer = '#blogCategoryTable';
		SGui.saveOrder = true;
		SGui.sort = true;
// Action buttons
		SGui.actionButtonRestore = '.action-restore';
		SGui.actionButtonDelete = '.action-delete';
// Delete messages
		SGui.actionDeleteMessage = 'Sto eliminando la categoria...';
		SGui.actionDeleteQuestion = 'Sei sicuro di voler eliminare la categoria selezionata?';
// Restore messages
		SGui.actionRestoreMessage = 'Sto ripristinando la categoria...';
		SGui.actionRestoreQuestion = 'Sei sicuro di voler ripristinare la categoria selezionata?';
// Start script
		SGui.init();
		
		
		/***/
	}),
	
	/***/ "./packages/ikdev/ikpanel/src/resources/assets/js/modules/modern-gui.js":
	/*!******************************************************************************!*\
	  !*** ./packages/ikdev/ikpanel/src/resources/assets/js/modules/modern-gui.js ***!
	  \******************************************************************************/
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
	
	/***/ "./packages/ikdev/ikpanel/src/resources/assets/js/modules/simple-gui.js":
	/*!******************************************************************************!*\
	  !*** ./packages/ikdev/ikpanel/src/resources/assets/js/modules/simple-gui.js ***!
	  \******************************************************************************/
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
		
		var modern_gui_1 = __webpack_require__(/*! ./modern-gui */ "./packages/ikdev/ikpanel/src/resources/assets/js/modules/modern-gui.js");
		
		var items_in_page_1 = __webpack_require__(/*! ./tools/items-in-page */ "./packages/ikdev/ikpanel/src/resources/assets/js/modules/tools/items-in-page.js");
		
		var SimpleGui =
			/** @class */
			function() {
				function SimpleGui() {
					this.table = null;
					this.statusFilter = null;
					this.searchFilter = null;
					this.filterUrlPrefix = null;
					this.itemInTable = null;
					this.itemInTableInput = null;
					this.resultContainer = null;
					this.saveOrder = false;
					this.sort = true;
					this.stateSave = false; // Pulsanti azione
					
					this.actionButtonDelete = null;
					this.actionButtonRestore = null; // Messaggi
					
					this.actionDeleteMessage = null;
					this.actionDeleteQuestion = null;
					this.actionRestoreMessage = null;
					this.actionRestoreQuestion = null;
				}
				
				SimpleGui.prototype.init = function() {
					var main = this,
						statusFilter = $(this.statusFilter),
						searchFilter = $(this.searchFilter),
						resultContainer = $(this.resultContainer),
						tableName = $(this.table),
						body = $('body'),
						ipp = null;
					
					if(main.saveOrder) {
						var sortable_1 = tableName.find('tbody').sortable({
							items: "> tr",
							cursor: 'move',
							opacity: 0.8,
							handle: '.handle',
							helper: function helper(e, tr) {
								var $originals = tr.children();
								var $helper = tr.clone();
								$helper.children().each(function(index) {
									$(this).width($originals.eq(index).width());
									$(this).width($originals.eq(index).width());
								});
								return $helper;
							},
							update: function update(event, ui) {
								var parameters = sortable_1.sortable('toArray', {
									attribute: 'data-id'
								});
								var start = tableName.DataTable().page.info().start;
								var items = [];
								
								for(var key in parameters) {
									var item = {};
									item['id'] = Number(parameters[key]);
									item['order'] = Number(key) + Number(start) + 1;
									items.push(item);
								}
								
								$.ajax({
									type: 'PUT',
									contentType: 'application/json',
									url: admin_panel_url + "/" + main.filterUrlPrefix + "/update-order",
									data: JSON.stringify({
										items: items
									}),
									success: function success(data) {
									},
									error: function error(xhr) {
										sendNotifications(xhr);
									},
									beforeSend: function beforeSend() {
									},
									complete: function complete() {
									}
								});
							}
						});
					}
					
					var table = tableName.DataTable(main.getDataTableSettings());
					statusFilter.select2();
					searchFilter.triggerHandler('focus');
					$('[data-toggle=tip]').tooltip({
						container: 'body',
						placement: 'left'
					});
					
					if(main.itemInTableInput !== null) {
						ipp = new items_in_page_1.default('#item-per-page-skills', 'ipp-skills');
						ipp.on('change', function(value) {
							table.page.len(value).draw();
						});
					} // Filtro ricerca
					
					
					body.on('keyup', main.searchFilter, function() {
						var terms = String(searchFilter.val());
						table.search(terms).draw();
						
						if(main.saveOrder) {
							if(terms.length > 0) {
								table.column(0).visible(false);
							} else {
								table.column(0).visible(true);
							}
							
							table.columns.adjust().draw();
						}
					}); // Cambio status
					
					body.on('change', this.statusFilter, function() {
						var term = String(statusFilter.val());
						$.ajax({
							type: 'GET',
							url: admin_panel_url + "/" + main.filterUrlPrefix + "/filter/" + term,
							success: function success(data) {
								resultContainer.html(data);
								table = tableName.DataTable(main.getDataTableSettings());
								table.search(term);
								$('[data-toggle=tip]').tooltip({
									container: 'body',
									placement: 'left'
								});
							},
							error: function error(xhr) {
								sendNotifications(xhr);
							},
							beforeSend: function beforeSend() {
								table.clear();
								table.destroy();
								modern_gui_1.default.loading(true);
							},
							complete: function complete() {
								modern_gui_1.default.loading(false);
							}
						});
					}); // Rimuovo oggetto
					
					body.on('click', this.actionButtonDelete, function() {
						return __awaiter(this, void 0, void 0, function() {
							var itemID;
							return __generator(this, function(_a) {
								switch(_a.label) {
									case 0:
										itemID = $(this).data('id');
										return [4
											/*yield*/
											, modern_gui_1.default.confirm(main.actionDeleteQuestion)];
									
									case 1:
										if(_a.sent()) {
											$.ajax({
												type: 'DELETE',
												contentType: 'application/json',
												url: admin_panel_url + "/" + main.filterUrlPrefix + "/delete/" + itemID,
												success: function success() {
													location.reload();
												},
												error: function error(xhr) {
													sendNotifications(xhr);
												},
												beforeSend: function beforeSend() {
													modern_gui_1.default.loading(true, main.actionDeleteMessage);
												},
												complete: function complete() {
													modern_gui_1.default.loading(false);
												}
											});
										}
										
										return [2
											/*return*/
										];
								}
							});
						});
					}); // Ripristino oggetto
					
					body.on('click', this.actionButtonRestore, function() {
						return __awaiter(this, void 0, void 0, function() {
							var itemID;
							return __generator(this, function(_a) {
								switch(_a.label) {
									case 0:
										itemID = $(this).data('id');
										return [4
											/*yield*/
											, modern_gui_1.default.confirm(main.actionRestoreQuestion)];
									
									case 1:
										if(_a.sent()) {
											$.ajax({
												type: 'PUT',
												contentType: 'application/json',
												url: admin_panel_url + "/" + main.filterUrlPrefix + "/restore/" + itemID,
												success: function success() {
													location.reload();
												},
												error: function error(xhr) {
													sendNotifications(xhr);
												},
												beforeSend: function beforeSend() {
													modern_gui_1.default.loading(true, main.actionRestoreMessage);
												},
												complete: function complete() {
													modern_gui_1.default.loading(false);
												}
											});
										}
										
										return [2
											/*return*/
										];
								}
							});
						});
					});
				};
				
				SimpleGui.prototype.getDataTableSettings = function() {
					var main = this;
					return {
						sDom: "<'table-responsive't><'row'<p i>>",
						sPaginationType: "bootstrap",
						destroy: true,
						scrollCollapse: true,
						ordering: main.sort,
						stateSave: main.stateSave,
						oLanguage: {
							sLengthMenu: "_MENU_ ",
							sInfo: "Stai visualizzando da <b>_START_ a _END_</b> su _TOTAL_ risultati",
							sInfoFiltered: "(filtrato da _MAX_ elementi)",
							sEmptyTable: "Nessun dato disponibile.",
							sInfoEmpty: "Nessun dato disponibile.",
							sZeroRecords: "Nessun dato da mostrare."
						},
						iDisplayLength: main.itemInTable
					};
				};
				
				return SimpleGui;
			}();
		
		exports.default = SimpleGui;
		
		/***/
	}),
	
	/***/ "./packages/ikdev/ikpanel/src/resources/assets/js/modules/tools/items-in-page.js":
	/*!***************************************************************************************!*\
	  !*** ./packages/ikdev/ikpanel/src/resources/assets/js/modules/tools/items-in-page.js ***!
	  \***************************************************************************************/
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
		
		var events_1 = __webpack_require__(/*! events */ "./node_modules/events/events.js");
		
		var ItemInPage =
			/** @class */
			function(_super) {
				__extends(ItemInPage, _super);
				
				function ItemInPage(container, itemID, range) {
					if(range === void 0) {
						range = [10, 25, 50, 100];
					}
					
					var _this = _super.call(this) || this;
					
					_this.saveInCookie = true;
					_this.container = container;
					_this.range = range;
					
					_this.range.push(-1);
					
					_this.itemID = itemID;
					
					_this.init();
					
					return _this;
				}
				
				/**
				 * Ottengo valore attuale dell'IPP
				 */
				
				
				ItemInPage.prototype.getValue = function() {
					return Number($("#" + this.itemID).val());
				};
				/**
				 * Imposto un valore all'IPP
				 * @param value
				 */
				
				
				ItemInPage.prototype.setValue = function(value) {
					var main = this,
						select = $("#" + main.itemID);
					select.val(value).trigger('change.select2');
				};
				/**
				 * Ricarico il valore dal cookie se disponibile
				 */
				
				
				ItemInPage.prototype.setFromCookie = function() {
					var main = this,
						select = $("#" + main.itemID),
						cookieName = main.itemID + "-cookie";
					
					if(Cookies.get(cookieName) !== undefined) {
						//leggo cookie per impostare l'elemento
						select.find("option[value=\"" + Cookies.get(cookieName) + "\"]").prop('selected', true).trigger('change.select2');
					}
				};
				/**
				 * Inizializza componente
				 */
				
				
				ItemInPage.prototype.init = function() {
					var main = this,
						container = $(this.container); //creo componente e lo stampo
					
					container.html(main.makeHTML()); //inizializzo componente select2
					
					main.parseElement(); //salvo/ottengo stato in cookie
					
					main.setCookie(); //emetto evento on change
					
					$("#" + main.itemID).on('change', function() {
						main.emit('change', main.getValue());
					});
					/*console.log('============================IPP initialized=============================');
					console.log('container: '+main.container);
					console.log('itemID: '+main.itemID);
					console.log('range: '+main.range);
					console.log('getValue: '+main.getValue());
					console.log('========================================================================');*/
				};
				/**
				 * Crea componente HTML
				 */
				
				
				ItemInPage.prototype.makeHTML = function() {
					var container = document.createElement('div'),
						label = document.createElement('label'),
						labelText = document.createTextNode('Elementi da visualizzare'),
						select = document.createElement('select');
					container.classList.add('form-group', 'form-group-default', 'form-group-default-select2'); //stile container da contenitore padre
					
					container.style.cssText = $(this.container).data('style-container'); //dimensione input
					
					var input_size = $(this.container).data('input-size');
					
					switch(input_size) {
						case 'lg':
							select.classList.add('input-lg');
							break;
						
						case 'md':
							select.classList.add('input-md');
							break;
						
						case 'xs':
						case 'xxs':
							select.classList.add('input-sm');
							break;
					}
					
					select.id = this.itemID;
					
					if($(this.container).data('input-fullwidth') !== false) {
						select.classList.add('full-width');
					}
					
					select.setAttribute('autocomplete', 'off');
					label.setAttribute('for', this.itemID);
					label.appendChild(labelText);
					
					for(var i in this.range) {
						var option = document.createElement('option'),
							optionText = null,
							item = String(this.range[i]);
						
						if(Number(item) !== -1) {
							optionText = document.createTextNode(item);
						} else {
							optionText = document.createTextNode('Tutti');
						} // if
						
						
						option.value = item;
						option.appendChild(optionText);
						select.appendChild(option);
					} // for
					
					
					container.appendChild(label);
					container.appendChild(select);
					return input_size == 'xxs' ? select.outerHTML : container.outerHTML;
				};
				/**
				 * Inizializzo componente select2
				 */
				
				
				ItemInPage.prototype.parseElement = function() {
					var main = this;
					$("#" + main.itemID).select2({
						width: $(this.container).data('input-width')
					});
				};
				/**
				 * Salvo/ottengo stato in cookie
				 */
				
				
				ItemInPage.prototype.setCookie = function() {
					var main = this,
						select = $("#" + main.itemID),
						cookieName = main.itemID + "-cookie";
					
					if(main.saveInCookie) {
						//inizializzo cookie
						if(Cookies.get(cookieName) === undefined) {
							Cookies.set(cookieName, select.val());
						} //leggo cookie per impostare l'elemento
						
						
						select.find("option[value=\"" + Cookies.get(cookieName) + "\"]").prop('selected', true).trigger('change'); //salvo elemento nel cookie se cambia
						
						select.on('change', function() {
							if(main.saveInCookie) {
								Cookies.set(cookieName, select.val());
							}
						});
					}
				};
				
				return ItemInPage;
			}(events_1.EventEmitter);
		
		exports.default = ItemInPage;
		
		/***/
	}),
	
	/***/ 0:
	/*!*********************************************************************************************************!*\
	  !*** multi ./packages/ikdev/ikpanel/src/Modules/blog/resources/assets/js/components/categories/show.ts ***!
	  \*********************************************************************************************************/
	/*! no static exports found */
	/***/ (function(module, exports, __webpack_require__) {
		
		module.exports = __webpack_require__(/*! C:\Users\roberto.ferro\PhpstormProjects\ikpanel-full\packages\ikdev\ikpanel\src\Modules\blog\resources\assets\js\components\categories\show.ts */"./packages/ikdev/ikpanel/src/Modules/blog/resources/assets/js/components/categories/show.ts");
		
		
		/***/
	})
	
	/******/
});