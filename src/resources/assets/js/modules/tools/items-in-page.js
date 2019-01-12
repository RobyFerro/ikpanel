"use strict";
var __extends = (this && this.__extends) || (function() {
	var extendStatics = function(d, b) {
		extendStatics = Object.setPrototypeOf ||
			({__proto__: []} instanceof Array && function(d, b) {
				d.__proto__ = b;
			}) ||
			function(d, b) {
				for(var p in b) if(b.hasOwnProperty(p)) d[p] = b[p];
			};
		return extendStatics(d, b);
	};
	return function(d, b) {
		extendStatics(d, b);
		
		function __() {
			this.constructor = d;
		}
		
		d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
	};
})();
Object.defineProperty(exports, "__esModule", {value: true});
var events_1 = require("events");
var ItemInPage = /** @class */ (function(_super) {
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
		var main = this, select = $("#" + main.itemID);
		select.val(value).trigger('change.select2');
	};
	/**
	 * Ricarico il valore dal cookie se disponibile
	 */
	ItemInPage.prototype.setFromCookie = function() {
		var main = this, select = $("#" + main.itemID), cookieName = main.itemID + "-cookie";
		if(Cookies.get(cookieName) !== undefined) {
			//leggo cookie per impostare l'elemento
			select.find("option[value=\"" + Cookies.get(cookieName) + "\"]")
				.prop('selected', true)
				.trigger('change.select2');
		}
	};
	/**
	 * Inizializza componente
	 */
	ItemInPage.prototype.init = function() {
		var main = this, container = $(this.container);
		//creo componente e lo stampo
		container.html(main.makeHTML());
		//inizializzo componente select2
		main.parseElement();
		//salvo/ottengo stato in cookie
		main.setCookie();
		//emetto evento on change
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
		var container = document.createElement('div'), label = document.createElement('label'),
			labelText = document.createTextNode('Elementi da visualizzare'), select = document.createElement('select');
		container.classList.add('form-group', 'form-group-default', 'form-group-default-select2');
		//stile container da contenitore padre
		container.style.cssText = $(this.container).data('style-container');
		//dimensione input
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
			var option = document.createElement('option'), optionText = null, item = String(this.range[i]);
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
		var main = this, select = $("#" + main.itemID), cookieName = main.itemID + "-cookie";
		if(main.saveInCookie) {
			//inizializzo cookie
			if(Cookies.get(cookieName) === undefined) {
				Cookies.set(cookieName, select.val());
			}
			//leggo cookie per impostare l'elemento
			select.find("option[value=\"" + Cookies.get(cookieName) + "\"]")
				.prop('selected', true)
				.trigger('change');
			//salvo elemento nel cookie se cambia
			select.on('change', function() {
				if(main.saveInCookie) {
					Cookies.set(cookieName, select.val());
				}
			});
		}
	};
	return ItemInPage;
}(events_1.EventEmitter));
exports.default = ItemInPage;
