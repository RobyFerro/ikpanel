declare let admin_panel_url: any;
declare let app_url: any;

export default class FormUtils {
	
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
			} else if (current.is('select') && current.hasClass('tag')) {
				value = me.parseSelect2Data(current.select2('data'));
			} else if (current.hasClass('money')) {
				if (current.val()) {
					value = current.maskMoney('unmasked')[0];
				} else {
					value = null;
				} // if
			} else {
				value = current.val();
			} // if
			
			obj[current.attr(id)] =
				value === null || (typeof value === 'string' && value.length === 0) ? null : value;
		});
		
		//restituisco l'array
		return obj;
	}
	
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
	
	static isModalOpen(modal: string): boolean {
		let modalIsShown = ($(modal).data('bs.modal') || {})._isShown;
		return !(typeof modalIsShown === 'undefined' || !modalIsShown);
	}
	
	static delay(time: number): Promise<void> {
		return new Promise<void>(function (resolve) {
			setTimeout(function () {
				resolve();
			}, time);
		});
	}
}