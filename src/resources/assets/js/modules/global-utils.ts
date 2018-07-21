export default class GolbalUtils {
	
	static retrieveAllInputs(selector?) {
		//imposto selettore di default se non impostato
		let theselector = selector === undefined ? '.form-data' : selector,
			me = this;
		
		//prendo i valori degli elementi
		let obj = {};
		
		$(theselector).each(function () {
			let current = $(this),
				value = null;
			
			if (current.is('input[type=file]')) {
				return null;
			} else if (current.is('input[type=checkbox]')) {
				console.log('checkbox');
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
			
			obj[current.prop('id')] = value === null || (typeof value === 'string' && value.length === 0) ? null : value;
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
	
}