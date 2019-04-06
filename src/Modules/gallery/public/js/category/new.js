/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 10);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/Modules/gallery/resources/assets/js/components/categories/new.ts":
/*!******************************************************************************!*\
  !*** ./src/Modules/gallery/resources/assets/js/components/categories/new.ts ***!
  \******************************************************************************/
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
Object.defineProperty(exports, "__esModule", { value: true });
var form_utils_1 = __webpack_require__(/*! @ikpanel/form_utils */ "./src/resources/assets/js/modules/form_utils.js");
var modern_gui_1 = __webpack_require__(/*! @ikpanel/modern-gui */ "./src/resources/assets/js/modules/modern-gui.js");
$(function () {
    var body = $('body');
    $('#categoryDescription').ckeditor(function () {
    }, {
        language: 'it',
        height: 500
    });
    body.on('click', '.action-save', function () {
        var object = form_utils_1.default.retrieveAllInputs(), action = $(this).data('action');
        $.ajax({
            type: 'POST',
            url: admin_panel_url + "/mod/gallery/categories/new",
            data: object,
            beforeSend: function () {
                modern_gui_1.default.loading(true, 'Creazione categoria in corso...');
            },
            success: function (data) {
                switch (action) {
                    case 'close':
                        location.reload();
                        break;
                    default:
                        location.href = admin_panel_url + "/mod/gallery/categories/edit/" + data;
                        break;
                } // switch
            },
            error: function (xhr) {
                form_utils_1.default.sendNotifications(xhr);
            },
            complete: function () {
                modern_gui_1.default.loading(false);
            }
        });
    });
});


/***/ }),

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
function () {
  function FormUtils() {}
  /**
   * Inizializza il componente select2 a nazione e città
   * @param {number} country_id ID nazione-
   * @param {number} city_id ID città
   * @param {string} modal ID modal. Se presente
   * @param {string} side Modalità: back|front
   */


  FormUtils.setCountryAndCity = function (country_id, city_id, side, modal) {
    if (side === void 0) {
      side = 'back';
    }

    if (modal === void 0) {
      modal = null;
    }

    var baseURL = null,
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
    country.on('change', function () {
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


  FormUtils.loadCountryAndCity = function (countryID, cityID, countrySelector, citySelector) {
    if (countrySelector === void 0) {
      countrySelector = '#country';
    }

    if (citySelector === void 0) {
      citySelector = '#city';
    }

    return new Promise(function (resolve, reject) {
      var country = $(countrySelector),
          city = $(citySelector); //nazione

      country.val(countryID).trigger('change'); //città

      $.ajax({
        type: 'GET',
        url: admin_panel_url + "/city/" + cityID
      }).then(function (data) {
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
      }).fail(function (err) {
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


  FormUtils.setTags = function (skill_id, action, modal, hide_disabled) {
    if (modal === void 0) {
      modal = 'body';
    }

    if (hide_disabled === void 0) {
      hide_disabled = false;
    }

    var skill = $(skill_id),
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
          createSearchChoice: function createSearchChoice(term, data) {
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
          createTag: function createTag(params) {
            return null;
          }
        };
        break;
    } // switch


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
      var data = [];
      var current = $(this).select2('data');

      for (var key in current) {
        var item = current[key];

        if (item.id === item.text) {
          if (data.indexOf(item.id) !== -1) {
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


  FormUtils.loadTags = function (tags, selector) {
    if (selector === void 0) {
      selector = '#skills';
    }

    var obj = $(selector);
    obj.find('option:selected').removeAttr('selected');

    for (var key in tags) {
      var item = tags[key];
      obj.find("option[value=" + item + "]").prop('selected', true);
    }

    obj.trigger('change', -1);
  };
  /**
   * Ottiene i valori da un input select2 di tipo tag
   * @param {string} selector Selettore input
   */


  FormUtils.getTags = function (selector) {
    return this.parseSelect2Data($(selector).select2('data'));
  };
  /**
   * Ottiene tutti i campi dalla vista
   * @param selector
   * @param id
   */


  FormUtils.retrieveAllInputs = function (selector, id) {
    if (selector === void 0) {
      selector = '.form-data';
    }

    if (id === void 0) {
      id = 'id';
    }

    var me = this; //prendo i valori degli elementi

    var obj = {};
    $(selector).each(function () {
      var current = $(this),
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


  FormUtils.parseSelect2Data = function (data) {
    var output = [];

    for (var key in data) {
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


  FormUtils.isModalOpen = function (modal) {
    var modalIsShown = ($(modal).data('bs.modal') || {})._isShown;

    return !(typeof modalIsShown === 'undefined' || !modalIsShown);
  };
  /**
   * Ritarda l'esecuzione dello script per un tempo definito in millisecondi
   * @param time Millisecondi
   */


  FormUtils.delay = function (time) {
    return new Promise(function (resolve) {
      setTimeout(function () {
        resolve();
      }, time);
    });
  };
  /**
   * Controlla se un array è uguale ad un altro (ignorando posizioni diverse)
   * @param a
   * @param b
   */


  FormUtils.arraysEqual = function (a, b) {
    if (a === b) return true;
    if (a == null || b == null) return false;
    if (a.length != b.length) return false;
    a.sort();
    b.sort();

    for (var i = 0; i < a.length; ++i) {
      if (a[i] !== b[i]) return false;
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


  FormUtils.setInputFile = function (buttonSelector, inputSelector, textSelector, onChange) {
    if (onChange === void 0) {
      onChange = null;
    } //click bottone custom => trigger input file


    $(buttonSelector).on('click', function () {
      $(inputSelector).trigger('click');
    }); //alla selezione di un nuovo file => trigger evento

    $(inputSelector).on('change', function (e) {
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


  FormUtils.setInputAvatar = function (buttonSelector, inputSelector, imageSelector, onChange) {
    if (onChange === void 0) {
      onChange = null;
    }

    var filereader = new FileReader(); //click bottone custom => trigger input file

    $(buttonSelector).on('click', function () {
      $(inputSelector).trigger('click');
    }); //alla selezione di un nuovo file => trigger evento

    $(inputSelector).on('change', function (e) {
      filereader.readAsDataURL(e.target.files[0]);
    });

    filereader.onload = function (e) {
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


  FormUtils.setIfNull = function (selector, value, datepicker) {
    if (datepicker === void 0) {
      datepicker = false;
    }

    var input = $(selector);

    if (String(input.val()).length == 0) {
      if (datepicker) {
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


  FormUtils.getInputFormDataJson = function (selector, id) {
    if (selector === void 0) {
      selector = '.form-data';
    }

    if (id === void 0) {
      id = 'id';
    } //ottengo i dati di input file


    var formdata = new FormData();
    var values = [];
    $(selector).each(function () {
      var current = $(this),
          item = {
        id: current.prop(id),
        value: null
      };

      if (current.is('input[type=file]')) {
        formdata.append(current.prop(id), current[0].files.length > 0 ? current[0].files[0] : '');
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
    formdata.append('data', JSON.stringify(values)); //restituisco form data

    return formdata;
  };
  /**
   * Converte un oggetto in un FormData
   * @param {object} obj
   * @returns {FormData}
   */


  FormUtils.objectToFormData = function (obj) {
    var formdata = new FormData();
    formdata.append('data', JSON.stringify(obj));
    return formdata;
  };
  /**
   * Invia una notifica di errore da un xhr (ajax)
   * @param xhr
   */


  FormUtils.sendNotifications = function (xhr) {
    if (xhr.responseText === undefined || xhr.responseText === null) {
      return;
    }

    var body = $('body'),
        response = JSON.parse(xhr.responseText),
        errors = response.errors;

    if (response.exception !== undefined) {
      //@ts-ignore
      body.pgNotification({
        "style": "simple",
        "message": "\n\t\t\t\t\t<b>Eccezione: </b> " + response.exception + "<br>\n\t\t\t\t\t<b>Messaggio: </b> " + response.message + "<br>\n\t\t\t\t\t<b>File: </b> " + response.file + "<br>\n\t\t\t\t\t<b>Line: </b> " + response.line,
        "showClose": true,
        "type": "danger"
      }).show();
    } else if (errors === undefined) {
      //@ts-ignore
      body.pgNotification({
        "style": "simple",
        "message": "<span><strong>Attenzione: </strong></span> " + response.message,
        "showClose": true,
        "type": "danger"
      }).show();
    } else {
      for (var err in errors) {
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


  FormUtils.stripHTML = function (data) {
    var tmp = document.createElement('div');
    tmp.innerHTML = data;
    return tmp.textContent || tmp.innerText || "";
  };
  /**
   * Maschera input con il template orario 24h
   * @param {string} selector
   */


  FormUtils.maskTime = function (selector) {
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

/***/ }),

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
function () {
  function ModernGui() {}
  /**
   * Visualizza un'interfaccia di alert
   * @param {string} message
   * @returns {Promise<void>}
   */


  ModernGui.alert = function (message) {
    var main = this;
    return new Promise(function (resolve) {
      //imposto messaggio
      main.modernGUI.malert.message.html(message); //assegno evento click bottone "ok"

      main.modernGUI.malert.ok.off().on('click', function () {
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


  ModernGui.confirm = function (message) {
    var main = this;
    return new Promise(function (resolve) {
      //imposto il messaggio
      main.modernGUI.mconfirm.message.html(message); //evento bottone "ok"

      main.modernGUI.mconfirm.ok.off().on('click', function () {
        main.modernGUI.mconfirm.gui.modal('hide');
        resolve(true);
      }); //evento bottone "annulla"

      main.modernGUI.mconfirm.cancel.off().on('click', function () {
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


  ModernGui.prompt = function (message) {
    var main = this;
    return new Promise(function (resolve) {
      //imposto il messaggio
      main.modernGUI.mprompt.message.html(message); //evento bottone "ok"

      main.modernGUI.mprompt.ok.off().on('click', function () {
        main.modernGUI.mprompt.gui.modal('hide');
        resolve({
          result: true,
          text: main.modernGUI.mprompt.input.val().toString()
        });
        main.modernGUI.mprompt.input.val('');
      }); //evento bottone "annulla"

      main.modernGUI.mprompt.cancel.off().on('click', function () {
        main.modernGUI.mprompt.gui.modal('hide');
        resolve({
          result: false,
          text: main.modernGUI.mprompt.input.val().toString()
        });
        main.modernGUI.mprompt.input.val('');
      }); //evento input al click dei tasti

      main.modernGUI.mprompt.input.off().on('keyup', function (e) {
        if (e.keyCode === 13) {
          main.modernGUI.mprompt.gui.modal('hide');
          resolve({
            result: true,
            text: main.modernGUI.mprompt.input.val().toString()
          });
          main.modernGUI.mprompt.input.val('');
        }
      }); //evento alla visualizzazione della gui

      main.modernGUI.mprompt.gui.on('shown.bs.modal', function () {
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


  ModernGui.loading = function (status, message) {
    if (status === void 0) {
      status = true;
    }

    if (message === void 0) {
      message = 'Caricamento dei dati in corso...';
    }

    var main = this; //imposto delay e mostro/nascondo gui

    setTimeout(function () {
      if (status) {
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

/***/ }),

/***/ 10:
/*!************************************************************************************!*\
  !*** multi ./src/Modules/gallery/resources/assets/js/components/categories/new.ts ***!
  \************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\roberto.ferro\PhpstormProjects\ikpanel\packages\ikdev\ikpanel\src\Modules\gallery\resources\assets\js\components\categories\new.ts */"./src/Modules/gallery/resources/assets/js/components/categories/new.ts");


/***/ })

/******/ });
//# sourceMappingURL=new.js.map