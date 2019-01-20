export default class Utils {
	
	/**
	 * Controlla se un variabile è vuota
	 * @param variable
	 * @param {boolean} strict
	 * @returns {boolean}
	 */
	public static empty(variable: any, strict: boolean = false): boolean {
		
		if (variable === "" || variable === null || variable === undefined) {
			return true;
		}
		
		let count = 0;
		if (typeof variable === "object") {
			for (let key in variable) {
				count++;
			}
			if (count == 0) {
				return true;
			}
		}
		
		
		if (strict) {
			
			if (variable === 0 || variable === "0" || variable === false) {
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * Genera un uuid randomico
	 * @returns {string}
	 */
	public static uuid(): string {
		return Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
	}
	
	/**
	 * Controlla se una stringa si trova dentro un'array di stringhe
	 * @param {string} value
	 * @param {Array<string>} array
	 * @returns {boolean}
	 */
	public static in_array(value: string, array: Array<string>): boolean {
		return array.indexOf(value) !== -1;
	}
	
	/**
	 * Esegue il codice nella callback al click dei bottoni CTRL + Tasto Custom (Default: ArrowRight)
	 * @param {() => void} onKeyUp
	 * @param {string} keyCode
	 * @param debugInfo
	 */
	public static debug(onKeyUp: () => void, keyCode: string = 'ArrowRight', debugInfo: boolean = true): void {
		$('body').off('keyup.debug.' + keyCode).on('keyup.debug.' + keyCode, function (e) {
			if (e.ctrlKey && e.key == keyCode) {
				if (debugInfo) {
					console.log('=============DEBUG============');
				}
				onKeyUp();
				if (debugInfo) {
					console.log('==============================');
				}
			}
		});
	}
	
	/**
	 * Converte i byte in un formato più leggibile
	 * @returns {any}
	 * @param bytes
	 */
	public static bytes2str(bytes: number): string {
		if (bytes >= 1073741824) {
			return this.round(bytes / 1073741824, 2) + ' GB';
		} else if (bytes >= 1048576) {
			return this.round(bytes / 1048576, 2) + ' MB';
		} else if (bytes >= 1024) {
			return this.round(bytes / 1024, 2) + ' KB';
		} else if (bytes > 1) {
			return bytes + ' bytes';
		} else if (bytes == 1) {
			return bytes + ' byte';
		} else {
			return '0 bytes';
		}
	}
	
	/**
	 * Approssima un numero decimale
	 * @param {number} number
	 * @param {number} decimal
	 * @returns {number}
	 */
	public static round(number: number, decimal: number) {
		let onumber = number + "e+" + decimal;
		return +(Math.round(Number(onumber)) + "e-" + decimal);
	}
	
	/**
	 * Inserisce del testo in un input element nella posizione del cursore
	 * @param {string} inputID
	 * @param {string} text
	 */
	public static insertAtCaret(inputID: string, text: string) {
		var txtarea = document.getElementById(inputID) as HTMLInputElement;
		if (!txtarea) {
			return;
		}
		
		var scrollPos = txtarea.scrollTop;
		var strPos = 0;
		//@ts-ignore
		var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ? "ff" : (document.selection ? "ie" : false));
		if (br == "ie") {
			txtarea.focus();
			//@ts-ignore
			var range = document.selection.createRange();
			range.moveStart('character', -txtarea.value.length);
			strPos = range.text.length;
		} else if (br == "ff") {
			strPos = txtarea.selectionStart;
		}
		
		var front = (txtarea.value).substring(0, strPos);
		var back = (txtarea.value).substring(strPos, txtarea.value.length);
		txtarea.value = front + text + back;
		strPos = strPos + text.length;
		if (br == "ie") {
			txtarea.focus();
			//@ts-ignore
			var ieRange = document.selection.createRange();
			ieRange.moveStart('character', -txtarea.value.length);
			ieRange.moveStart('character', strPos);
			ieRange.moveEnd('character', 0);
			ieRange.select();
		} else if (br == "ff") {
			txtarea.selectionStart = strPos;
			txtarea.selectionEnd = strPos;
			txtarea.focus();
		}
		
		txtarea.scrollTop = scrollPos;
	}
	
	/**
	 * Costruisce i parametri query per un url
	 * @param data
	 * @returns {string}
	 */
	public static buildQueryUrl(data: any): string {
		let ret = [];
		for (let d in data) {
			ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
		}
		
		if (ret.length > 0) {
			return '?' + ret.join('&');
		}
		
		return '';
	}
	
}
