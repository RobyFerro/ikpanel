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
	return __webpack_require__(__webpack_require__.s = 2);
	/******/
})
/************************************************************************/
/******/({
	
	/***/ "./node_modules/events/events.js":
	/*!***************************************!*\
	  !*** ./node_modules/events/events.js ***!
	  \***************************************/
	/*! no static exports found */
	/***/ (function(module, exports, __webpack_require__) {
		
		"use strict";
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
		
		
		var R = typeof Reflect === 'object' ? Reflect : null;
		var ReflectApply = R && typeof R.apply === 'function'
			? R.apply
			: function ReflectApply(target, receiver, args) {
				return Function.prototype.apply.call(target, receiver, args);
			};
		
		var ReflectOwnKeys;
		if(R && typeof R.ownKeys === 'function') {
			ReflectOwnKeys = R.ownKeys;
		} else if(Object.getOwnPropertySymbols) {
			ReflectOwnKeys = function ReflectOwnKeys(target) {
				return Object.getOwnPropertyNames(target)
					.concat(Object.getOwnPropertySymbols(target));
			};
		} else {
			ReflectOwnKeys = function ReflectOwnKeys(target) {
				return Object.getOwnPropertyNames(target);
			};
		}
		
		function ProcessEmitWarning(warning) {
			if(console && console.warn) console.warn(warning);
		}
		
		var NumberIsNaN = Number.isNaN || function NumberIsNaN(value) {
			return value !== value;
		};
		
		function EventEmitter() {
			EventEmitter.init.call(this);
		}
		
		module.exports = EventEmitter;

// Backwards-compat with node 0.10.x
		EventEmitter.EventEmitter = EventEmitter;
		
		EventEmitter.prototype._events = undefined;
		EventEmitter.prototype._eventsCount = 0;
		EventEmitter.prototype._maxListeners = undefined;

// By default EventEmitters will print a warning if more than 10 listeners are
// added to it. This is a useful default which helps finding memory leaks.
		var defaultMaxListeners = 10;
		
		Object.defineProperty(EventEmitter, 'defaultMaxListeners', {
			enumerable: true,
			get: function() {
				return defaultMaxListeners;
			},
			set: function(arg) {
				if(typeof arg !== 'number' || arg < 0 || NumberIsNaN(arg)) {
					throw new RangeError('The value of "defaultMaxListeners" is out of range. It must be a non-negative number. Received ' + arg + '.');
				}
				defaultMaxListeners = arg;
			}
		});
		
		EventEmitter.init = function() {
			
			if(this._events === undefined ||
				this._events === Object.getPrototypeOf(this)._events) {
				this._events = Object.create(null);
				this._eventsCount = 0;
			}
			
			this._maxListeners = this._maxListeners || undefined;
		};

// Obviously not all Emitters should be limited to 10. This function allows
// that to be increased. Set to zero for unlimited.
		EventEmitter.prototype.setMaxListeners = function setMaxListeners(n) {
			if(typeof n !== 'number' || n < 0 || NumberIsNaN(n)) {
				throw new RangeError('The value of "n" is out of range. It must be a non-negative number. Received ' + n + '.');
			}
			this._maxListeners = n;
			return this;
		};
		
		function $getMaxListeners(that) {
			if(that._maxListeners === undefined)
				return EventEmitter.defaultMaxListeners;
			return that._maxListeners;
		}
		
		EventEmitter.prototype.getMaxListeners = function getMaxListeners() {
			return $getMaxListeners(this);
		};
		
		EventEmitter.prototype.emit = function emit(type) {
			var args = [];
			for(var i = 1; i < arguments.length; i++) args.push(arguments[i]);
			var doError = (type === 'error');
			
			var events = this._events;
			if(events !== undefined)
				doError = (doError && events.error === undefined);
			else if(!doError)
				return false;
			
			// If there is no 'error' event listener then throw.
			if(doError) {
				var er;
				if(args.length > 0)
					er = args[0];
				if(er instanceof Error) {
					// Note: The comments on the `throw` lines are intentional, they show
					// up in Node's output if this results in an unhandled exception.
					throw er; // Unhandled 'error' event
				}
				// At least give some kind of context to the user
				var err = new Error('Unhandled error.' + (er ? ' (' + er.message + ')' : ''));
				err.context = er;
				throw err; // Unhandled 'error' event
			}
			
			var handler = events[type];
			
			if(handler === undefined)
				return false;
			
			if(typeof handler === 'function') {
				ReflectApply(handler, this, args);
			} else {
				var len = handler.length;
				var listeners = arrayClone(handler, len);
				for(var i = 0; i < len; ++i)
					ReflectApply(listeners[i], this, args);
			}
			
			return true;
		};
		
		function _addListener(target, type, listener, prepend) {
			var m;
			var events;
			var existing;
			
			if(typeof listener !== 'function') {
				throw new TypeError('The "listener" argument must be of type Function. Received type ' + typeof listener);
			}
			
			events = target._events;
			if(events === undefined) {
				events = target._events = Object.create(null);
				target._eventsCount = 0;
			} else {
				// To avoid recursion in the case that type === "newListener"! Before
				// adding it to the listeners, first emit "newListener".
				if(events.newListener !== undefined) {
					target.emit('newListener', type,
						listener.listener ? listener.listener : listener);
					
					// Re-assign `events` because a newListener handler could have caused the
					// this._events to be assigned to a new object
					events = target._events;
				}
				existing = events[type];
			}
			
			if(existing === undefined) {
				// Optimize the case of one listener. Don't need the extra array object.
				existing = events[type] = listener;
				++target._eventsCount;
			} else {
				if(typeof existing === 'function') {
					// Adding the second element, need to change to array.
					existing = events[type] =
						prepend ? [listener, existing] : [existing, listener];
					// If we've already got an array, just append.
				} else if(prepend) {
					existing.unshift(listener);
				} else {
					existing.push(listener);
				}
				
				// Check for listener leak
				m = $getMaxListeners(target);
				if(m > 0 && existing.length > m && !existing.warned) {
					existing.warned = true;
					// No error code for this since it is a Warning
					// eslint-disable-next-line no-restricted-syntax
					var w = new Error('Possible EventEmitter memory leak detected. ' +
						existing.length + ' ' + String(type) + ' listeners ' +
						'added. Use emitter.setMaxListeners() to ' +
						'increase limit');
					w.name = 'MaxListenersExceededWarning';
					w.emitter = target;
					w.type = type;
					w.count = existing.length;
					ProcessEmitWarning(w);
				}
			}
			
			return target;
		}
		
		EventEmitter.prototype.addListener = function addListener(type, listener) {
			return _addListener(this, type, listener, false);
		};
		
		EventEmitter.prototype.on = EventEmitter.prototype.addListener;
		
		EventEmitter.prototype.prependListener =
			function prependListener(type, listener) {
				return _addListener(this, type, listener, true);
			};
		
		function onceWrapper() {
			var args = [];
			for(var i = 0; i < arguments.length; i++) args.push(arguments[i]);
			if(!this.fired) {
				this.target.removeListener(this.type, this.wrapFn);
				this.fired = true;
				ReflectApply(this.listener, this.target, args);
			}
		}
		
		function _onceWrap(target, type, listener) {
			var state = {fired: false, wrapFn: undefined, target: target, type: type, listener: listener};
			var wrapped = onceWrapper.bind(state);
			wrapped.listener = listener;
			state.wrapFn = wrapped;
			return wrapped;
		}
		
		EventEmitter.prototype.once = function once(type, listener) {
			if(typeof listener !== 'function') {
				throw new TypeError('The "listener" argument must be of type Function. Received type ' + typeof listener);
			}
			this.on(type, _onceWrap(this, type, listener));
			return this;
		};
		
		EventEmitter.prototype.prependOnceListener =
			function prependOnceListener(type, listener) {
				if(typeof listener !== 'function') {
					throw new TypeError('The "listener" argument must be of type Function. Received type ' + typeof listener);
				}
				this.prependListener(type, _onceWrap(this, type, listener));
				return this;
			};

// Emits a 'removeListener' event if and only if the listener was removed.
		EventEmitter.prototype.removeListener =
			function removeListener(type, listener) {
				var list, events, position, i, originalListener;
				
				if(typeof listener !== 'function') {
					throw new TypeError('The "listener" argument must be of type Function. Received type ' + typeof listener);
				}
				
				events = this._events;
				if(events === undefined)
					return this;
				
				list = events[type];
				if(list === undefined)
					return this;
				
				if(list === listener || list.listener === listener) {
					if(--this._eventsCount === 0)
						this._events = Object.create(null);
					else {
						delete events[type];
						if(events.removeListener)
							this.emit('removeListener', type, list.listener || listener);
					}
				} else if(typeof list !== 'function') {
					position = -1;
					
					for(i = list.length - 1; i >= 0; i--) {
						if(list[i] === listener || list[i].listener === listener) {
							originalListener = list[i].listener;
							position = i;
							break;
						}
					}
					
					if(position < 0)
						return this;
					
					if(position === 0)
						list.shift();
					else {
						spliceOne(list, position);
					}
					
					if(list.length === 1)
						events[type] = list[0];
					
					if(events.removeListener !== undefined)
						this.emit('removeListener', type, originalListener || listener);
				}
				
				return this;
			};
		
		EventEmitter.prototype.off = EventEmitter.prototype.removeListener;
		
		EventEmitter.prototype.removeAllListeners =
			function removeAllListeners(type) {
				var listeners, events, i;
				
				events = this._events;
				if(events === undefined)
					return this;
				
				// not listening for removeListener, no need to emit
				if(events.removeListener === undefined) {
					if(arguments.length === 0) {
						this._events = Object.create(null);
						this._eventsCount = 0;
					} else if(events[type] !== undefined) {
						if(--this._eventsCount === 0)
							this._events = Object.create(null);
						else
							delete events[type];
					}
					return this;
				}
				
				// emit removeListener for all listeners on all events
				if(arguments.length === 0) {
					var keys = Object.keys(events);
					var key;
					for(i = 0; i < keys.length; ++i) {
						key = keys[i];
						if(key === 'removeListener') continue;
						this.removeAllListeners(key);
					}
					this.removeAllListeners('removeListener');
					this._events = Object.create(null);
					this._eventsCount = 0;
					return this;
				}
				
				listeners = events[type];
				
				if(typeof listeners === 'function') {
					this.removeListener(type, listeners);
				} else if(listeners !== undefined) {
					// LIFO order
					for(i = listeners.length - 1; i >= 0; i--) {
						this.removeListener(type, listeners[i]);
					}
				}
				
				return this;
			};
		
		function _listeners(target, type, unwrap) {
			var events = target._events;
			
			if(events === undefined)
				return [];
			
			var evlistener = events[type];
			if(evlistener === undefined)
				return [];
			
			if(typeof evlistener === 'function')
				return unwrap ? [evlistener.listener || evlistener] : [evlistener];
			
			return unwrap ?
				unwrapListeners(evlistener) : arrayClone(evlistener, evlistener.length);
		}
		
		EventEmitter.prototype.listeners = function listeners(type) {
			return _listeners(this, type, true);
		};
		
		EventEmitter.prototype.rawListeners = function rawListeners(type) {
			return _listeners(this, type, false);
		};
		
		EventEmitter.listenerCount = function(emitter, type) {
			if(typeof emitter.listenerCount === 'function') {
				return emitter.listenerCount(type);
			} else {
				return listenerCount.call(emitter, type);
			}
		};
		
		EventEmitter.prototype.listenerCount = listenerCount;
		
		function listenerCount(type) {
			var events = this._events;
			
			if(events !== undefined) {
				var evlistener = events[type];
				
				if(typeof evlistener === 'function') {
					return 1;
				} else if(evlistener !== undefined) {
					return evlistener.length;
				}
			}
			
			return 0;
		}
		
		EventEmitter.prototype.eventNames = function eventNames() {
			return this._eventsCount > 0 ? ReflectOwnKeys(this._events) : [];
		};
		
		function arrayClone(arr, n) {
			var copy = new Array(n);
			for(var i = 0; i < n; ++i)
				copy[i] = arr[i];
			return copy;
		}
		
		function spliceOne(list, index) {
			for(; index + 1 < list.length; index++)
				list[index] = list[index + 1];
			list.pop();
		}
		
		function unwrapListeners(arr) {
			var ret = new Array(arr.length);
			for(var i = 0; i < ret.length; ++i) {
				ret[i] = arr[i].listener || arr[i];
			}
			return ret;
		}
		
		
		/***/
	}),
	
	/***/ "./src/Modules/blog/resources/assets/js/components/articles/show.ts":
	/*!**************************************************************************!*\
	  !*** ./src/Modules/blog/resources/assets/js/components/articles/show.ts ***!
	  \**************************************************************************/
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
		Object.defineProperty(exports, "__esModule", {value: true});
		var simple_gui_1 = __webpack_require__(/*! ../../../../../../../resources/assets/js/modules/simple-gui */ "./src/resources/assets/js/modules/simple-gui.js");
		var SGui = new simple_gui_1.default();
// General settings
		SGui.table = '#blogPostsTable';
		SGui.searchFilter = '#search-filter';
		SGui.statusFilter = '#status-filter';
		SGui.filterUrlPrefix = 'mod/blog/articles';
		SGui.itemInTable = -1;
		SGui.resultContainer = '#blogPostsTable';
		SGui.saveOrder = true;
		SGui.sort = true;
// Action buttons
		SGui.actionButtonRestore = '.action-restore';
		SGui.actionButtonDelete = '.action-delete';
// Delete messages
		SGui.actionDeleteMessage = "Sto eliminando l'articolo...";
		SGui.actionDeleteQuestion = "Sei sicuro di voler eliminare l'articolo selezionato?";
// Restore messages
		SGui.actionRestoreMessage = "Sto ripristinando l'articolo...";
		SGui.actionRestoreQuestion = "Sei sicuro di voler ripristinare l'articolo selezionato?";
// Start script
		SGui.init();
		
		
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
	
	/***/ "./src/resources/assets/js/modules/simple-gui.js":
	/*!*******************************************************!*\
	  !*** ./src/resources/assets/js/modules/simple-gui.js ***!
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
		
		var modern_gui_1 = __webpack_require__(/*! ./modern-gui */ "./src/resources/assets/js/modules/modern-gui.js");
		
		var items_in_page_1 = __webpack_require__(/*! ./tools/items-in-page */ "./src/resources/assets/js/modules/tools/items-in-page.js");
		
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
	
	/***/ "./src/resources/assets/js/modules/tools/items-in-page.js":
	/*!****************************************************************!*\
	  !*** ./src/resources/assets/js/modules/tools/items-in-page.js ***!
	  \****************************************************************/
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
	
	/***/ 2:
	/*!********************************************************************************!*\
	  !*** multi ./src/Modules/blog/resources/assets/js/components/articles/show.ts ***!
	  \********************************************************************************/
	/*! no static exports found */
	/***/ (function(module, exports, __webpack_require__) {
		
		module.exports = __webpack_require__(/*! C:\Users\roberto.ferro\PhpstormProjects\ikpanel\packages\ikdev\ikpanel\src\Modules\blog\resources\assets\js\components\articles\show.ts */"./src/Modules/blog/resources/assets/js/components/articles/show.ts");
		
		
		/***/
	})
	
	/******/
});
//# sourceMappingURL=show.js.map
