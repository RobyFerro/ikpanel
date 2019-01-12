import {EventEmitter} from 'events';

declare let Cookies: any;

export default class ItemInPage extends EventEmitter {
	
	public saveInCookie: boolean = true;
	private container: string;
	private range: Array<number>;
	private itemID: string;
	
	constructor(container: string, itemID: string, range: Array<number> = [10, 25, 50, 100]) {
		super();
		
		this.container = container;
		this.range = range;
		this.range.push(-1);
		this.itemID = itemID;
		
		this.init();
	}
	
	/**
	 * Ottengo valore attuale dell'IPP
	 */
	public getValue(): number {
		return Number($(`#${this.itemID}`).val());
	}
	
	/**
	 * Imposto un valore all'IPP
	 * @param value
	 */
	public setValue(value: number) {
		let main = this,
			select = $(`#${main.itemID}`);
		
		select.val(value).trigger('change.select2');
	}
	
	/**
	 * Ricarico il valore dal cookie se disponibile
	 */
	public setFromCookie(): void {
		let main = this,
			select = $(`#${main.itemID}`),
			cookieName = `${main.itemID}-cookie`;
		
		if (Cookies.get(cookieName) !== undefined) {
			
			//leggo cookie per impostare l'elemento
			select.find(`option[value="${Cookies.get(cookieName)}"]`)
				.prop('selected', true)
				.trigger('change.select2')
		}
	}
	
	/**
	 * Inizializza componente
	 */
	private init(): void {
		let main = this,
			container = $(this.container);
		
		//creo componente e lo stampo
		container.html(main.makeHTML());
		
		//inizializzo componente select2
		main.parseElement();
		
		//salvo/ottengo stato in cookie
		main.setCookie();
		
		//emetto evento on change
		$(`#${main.itemID}`).on('change', function () {
			main.emit('change', main.getValue());
		});
		
		/*console.log('============================IPP initialized=============================');
		console.log('container: '+main.container);
		console.log('itemID: '+main.itemID);
		console.log('range: '+main.range);
		console.log('getValue: '+main.getValue());
		console.log('========================================================================');*/
	}
	
	/**
	 * Crea componente HTML
	 */
	private makeHTML(): string {
		
		let container = document.createElement('div'),
			label = document.createElement('label'),
			labelText = document.createTextNode('Elementi da visualizzare'),
			select = document.createElement('select');
		
		container.classList.add(
			'form-group',
			'form-group-default',
			'form-group-default-select2'
		);
		
		//stile container da contenitore padre
		container.style.cssText = $(this.container).data('style-container');
		
		//dimensione input
		let input_size = $(this.container).data('input-size');
		switch (input_size) {
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
		if ($(this.container).data('input-fullwidth') !== false) {
			select.classList.add('full-width');
		}
		select.setAttribute('autocomplete', 'off');
		
		label.setAttribute('for', this.itemID);
		label.appendChild(labelText);
		
		for (let i in this.range) {
			let option = document.createElement('option'),
				optionText = null,
				item = String(this.range[i]);
			
			if (Number(item) !== -1) {
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
		
	}
	
	/**
	 * Inizializzo componente select2
	 */
	private parseElement(): void {
		let main = this;
		$(`#${main.itemID}`).select2({
			width: $(this.container).data('input-width')
		});
	}
	
	/**
	 * Salvo/ottengo stato in cookie
	 */
	private setCookie(): void {
		let main = this,
			select = $(`#${main.itemID}`),
			cookieName = `${main.itemID}-cookie`;
		
		if (main.saveInCookie) {
			//inizializzo cookie
			if (Cookies.get(cookieName) === undefined) {
				Cookies.set(cookieName, select.val());
			}
			
			//leggo cookie per impostare l'elemento
			select.find(`option[value="${Cookies.get(cookieName)}"]`)
				.prop('selected', true)
				.trigger('change');
			
			//salvo elemento nel cookie se cambia
			select.on('change', function () {
				if (main.saveInCookie) {
					Cookies.set(cookieName, select.val());
				}
			});
		}
	}
}