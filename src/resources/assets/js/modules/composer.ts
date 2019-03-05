import FormUtils from "./form_utils";
import Notify from "./notify";
import Utils from "./utils";
import ModernGui from "./modern-gui";

declare let admin_panel_url: string;

export default abstract class Composer {
	
	//region PROPRIETÀ CLASSE
	private get selectedComponent(): string {
		return this._selectedComponent;
	}
	
	private set selectedComponent(value: string) {
		this._selectedComponent = value;
	}
	
	public get currentForm(): number {
		return this._currentForm;
	}
	
	public set currentForm(value: number) {
		this._currentForm = value;
		this.onCurrentFormChange();
	}
	
	private get availableComponents(): Array<IAvailableComponent> {
		return this._availableComponents;
	}
	
	private set availableComponents(value: Array<IAvailableComponent>) {
		this._availableComponents = value;
		this.onAvailableComponentsSet();
	}
	
	private get currentComponents(): IFormComponent[][] {
		return this._currentComponents;
	}
	
	private set currentComponents(value: IFormComponent[][]) {
		this._currentComponents = value;
		this.onCurrentComponentsSet();
	}
	
	//endregion
	
	//region VARIABILI
	
	//current form statico
	public isCurrentFormStatic: boolean = false;
	
	//rotte
	protected routes: IRoutes = {
		availableComponents: null,
		formComponents: null,
		saveForm: null
	};
	
	//tabs
	protected tabs: ITab[] = [];
	
	//selettori html
	private selector = {
		tab_presets: $('#tab-presets'),
		tab_unbounds: $('#tab-unbounds'),
		
		add_row_button: $('#builder-add-row-button'),
		add_row_modal: $('#modal-add-row'),
		add_row_add_column: $('#modal-add-row-add-column'),
		add_row_content: $('#modal-add-row-content')
	};
	
	//variabile private delle proprietà
	private _currentForm: number = null;
	private _availableComponents: Array<IAvailableComponent> = [];
	private _currentComponents: IFormComponent[][] = [];
	private _selectedComponent: string = null;
	
	//endregion
	
	//region METODI GESTIONE CLASSE
	
	/**
	 * Inizializza componenti html + eventi
	 * @return {Promise<void>}
	 */
	public async init() {
		let main = this,
			body: JQuery<HTMLElement> = $('body'),
			modalAddComponent: JQuery<HTMLElement> = $('#modal-add-component'),
			available_components_select: JQuery<HTMLElement> = $('#available-components-select');
		
		//region INIZIALIZZAZIONI COMPONENTI
		
		//inizializzo tooltip => BOTTONI SALVATAGGIO, RIMUOVI COMPONENTE
		body.tooltip({
			selector: '.builder-remove-row, .builder-remove-component',
			trigger: 'hover',
			placement: 'bottom'
		});
		
		//inizializzo select2 => POSIZIONE (MODAL AGGIUNGI COMPONENTE)
		$('#component-position').select2({
			placeholder: 'Seleziona posizione...',
			dropdownParent: modalAddComponent
		});
		
		//inizializzo select2 => PUNTEGGIO (MODAL AGGIUNGI COMPONENTE)
		$('#component-ranktype').select2({
			placeholder: 'Seleziona tipologia punteggio...',
			dropdownParent: modalAddComponent
		});
		
		//inizializzo sortable => RIGHE DEL FORM (GRIGLIA)
		$('#builder-grid').sortable({
			items: "> div",
			cursor: 'move',
			opacity: 0.8,
			handle: '.builder-sort-row',
			placeholder: 'builder-placeholder-row',
			helper: function (e, tr: any) {
				let $originals = tr.children();
				let $helper = tr.clone();
				$helper.children().each(function (index) {
					$(this).width($originals.eq(index).width());
					$(this).width($originals.eq(index).width());
				});
				return $helper;
			},
			start: function (event, ui) {
				ui.placeholder.html('Rilascia qui');
			},
			update: function () {
				
				//prendo gli indici correnti
				let indexes: Array<number> = $(this).sortable('toArray', {
					attribute: 'data-index'
				}).map(x => Number(x));
				
				//riordino le righe dei componenti
				let form: Array<any> = [];
				indexes.forEach(function (item) {
					form.push(main.currentComponents[item]);
				});
				
				//riaggiorno gli indici
				$('#builder-grid').children('div').each(function (index) {
					$(this)
						.removeAttr('data-index')
						.attr('data-index', index);
				});
				
				//salvo il nuovo oggetto
				main.currentComponents = form;
			}
		});
		
		//inizializzo select2 => TABS COMPONENTI DISPONIBILI
		available_components_select.select2({
			dropdownParent: $('#builder-content'),
			minimumResultsForSearch: -1,
			containerCssClass: 'composer'
		});
		
		available_components_select.empty();
		$('#available-components-tab-content').empty();
		main.tabs.forEach(function (value, index) {
			
			//creo opzioni per select2 tabs
			let option = `<option id="${index}" data-id="tab-${value.id}" ${index === 0 ? 'selected' : ''}>${value.title}</option>`;
			available_components_select.append(option);
			
			//creo pannelli per tabs
			let content = `
			<div class="tab-pane tab-components fade show ${index === 0 ? 'active' : ''}" id="tab-${value.id}" role="tabpanel">
				<div class="p-3">Caricamento in corso...</div>
			</div>
			`;
			$('#available-components-tab-content').append(content);
		});
		available_components_select.trigger('change.select2');
		
		//endregion
		
		//region EVENTI COMPONENTI
		
		//click bottone => NUOVA RIGA
		main.selector.add_row_button.on('click', function () {
			
			if (main.currentForm !== null) {
				main.clearNewRow();
				main.checkAddColumn();
				main.selector.add_row_modal.modal('show');
			} else {
				Notify.danger('Non hai selezionato nessun form!');
			}
			
		});
		
		//click bottone => RIMUOVI RIGA
		body.on('click', '.builder-remove-row', function () {
			let index = $(this).parents('.builder-row').data('index');
			$(this).tooltip('dispose');
			
			main.currentComponents.splice(index, 1);
			main.renderGrid();
		});
		
		//click bottone => SALVA RIGA (MODAL NUOVA RIGA)
		$('#modal-add-row-save').on('click', function () {
			let data = main.getNewRow();
			
			if (data.total !== 12) {
				Notify.danger('Le colonne nella riga non sono 12!');
			} else {
				
				let columns = [];
				for (let i in data.columns) {
					let item = data.columns[i];
					
					columns.push({
						span: item
					});
				}
				
				main.currentComponents.push(columns);
				main.renderGrid();
				main.selector.add_row_modal.modal('hide');
			}
		});
		
		//click bottone => NUOVA COLONNA
		main.selector.add_row_add_column.on('click', function (e) {
			e.preventDefault();
			main.addNewColumn();
		});
		
		//click bottone => RIMUOVI COLONNA
		body.on('click', '.modal-add-row-remove-column', function () {
			$(this).closest('.builder-new-column').remove();
			main.refreshColumnsLabel();
			main.checkAddColumn();
		});
		
		//click bottone => SALVA COLONNA (MODAL NUOVA RIGA)
		body.on('click', '.builder-column-save', function () {
			let parent = $(this).closest('.builder-new-column');
			let value = parent.find('select.modal-add-row-column-size').val();
			
			if (String(value).length > 0) {
				parent.find('span.builder-column-size-label').show();
				parent.find('span.builder-column-size-text').html(String(value));
				parent.find('select.modal-add-row-column-size').hide().select2('destroy');
				$(this).hide();
				parent.find('.modal-add-row-remove-column').show();
				main.checkAddColumn();
			} else {
				Notify.danger('Seleziona un elemento!');
			}
		});
		
		//click link => COMPONENTE DISPONIBILE
		body.on('click', '.available-component', function (e) {
			e.preventDefault();
			main.selectedComponent = $(this).data('code');
			let component_option = main.getAvailableComponentByCode(main.selectedComponent);
			
			$('#component-name').html(component_option.description);
			
			$('#component-description').val('');
			if (component_option.custom_label) {
				$('#component-description-content').show();
			} else {
				$('#component-description-content').hide();
			}
			
			$('#component-options-items').empty();
			if (component_option.type == 'SELECT' && !component_option.preset) {
				$('#component-options-content').show();
			} else {
				$('#component-options-content').hide();
			}
			
			if (component_option.code == 'range' || component_option.code == 'star') {
				$('#component-ranktype-content').show();
			} else {
				$('#component-ranktype-content').hide();
			}
			
			$('#modal-add-component').modal('show');
		});
		
		//click bottone => RIMUOVI COMPONENTE
		body.on('click', '.builder-remove-component', function () {
			let row = $(this).data('row');
			let col = $(this).data('col');
			$(this).tooltip('dispose');
			
			let properties = Object.getOwnPropertyNames(main.currentComponents[row][col]);
			for (let i in properties) {
				if (properties[i] !== 'span') {
					delete main.currentComponents[row][col][properties[i]];
				}
			}
			
			main.renderGrid();
		});
		
		//click bottone => SALVA COMPONENTE (MODAL AGGIUNGI COMPONENTE)
		$('#modal-add-component-save').on('click', function () {
			let componentDescription = $('#component-description');
			let componentRankType = $('#component-ranktype');
			
			let position = $('#component-position').val();
			
			if (position.toString().length > 0 && main.isPositionValid(position)) {
				let indexes = main.getColumnFromPosition(Number(position));
				let component_data = main.getAvailableComponentByCode(main.selectedComponent);
				
				let component_options = [];
				$('.component-option-text').each(function () {
					component_options.push(String($(this).val()));
				});
				
				if ((component_data.custom_label && componentDescription.val().toString().length == 0) ||
					(!component_data.preset && component_data.type == 'SELECT' && component_options.filter(x => x.toString().length == 0).length > 0) ||
					(['range', 'star'].includes(component_data.code) && componentRankType.val().toString().length == 0)
				) {
					Notify.danger('Parametri non corretti!');
					
				} else {
					main.currentComponents[indexes.row][indexes.col].code = main.selectedComponent;
					
					if (component_data.custom_label) {
						main.currentComponents[indexes.row][indexes.col].description = componentDescription.val().toString();
					}
					
					if (!component_data.preset && component_data.type == 'SELECT') {
						main.currentComponents[indexes.row][indexes.col].options = component_options;
					}
					
					if (['range', 'star'].includes(component_data.code)) {
						main.currentComponents[indexes.row][indexes.col].description = componentRankType.find('option:selected').text();
						main.currentComponents[indexes.row][indexes.col].ranktype = Number(componentRankType.val());
					}
					
					main.selectedComponent = null;
					main.renderGrid();
					$('#modal-add-component').modal('hide');
				}
			} else {
				Notify.danger('Parametri non corretti!');
			}
		});
		
		//click bottone => SALVA FORM
		$('#builder-save').on('click', async function () {
			if (main.currentForm !== null) {
				ModernGui.loading(true, 'Salvataggio form in corso...');
				await main.saveForm();
				ModernGui.loading(false);
				Notify.success('Il form è stato salvato correttamente!');
			} else {
				Notify.danger('Non hai selezionato nessun form!');
			} // if
		});
		
		//click link "Menu a tendina" => AGGIUNGI NUOVA OPZIONE (MODAL AGGIUNGI COMPONENTE)
		$('#component-options-add').on('click', function (e) {
			e.preventDefault();
			$('#component-options-items').append(`
				<div class="input-group input-group-sm mb-1 component-option">
					<input type="text" class="form-control component-option-text">
					<div class="input-group-append">
						<button class="btn btn-outline-secondary component-option-remove" type="button">
							<i class="fas fa-times fa-fw"></i>
						</button>
					</div>
				</div>
			`);
		});
		
		//click bottone => RIMUOVI OPZIONE (MODAL AGGIUNGI COMPONENTE)
		body.on('click', '.component-option-remove', function () {
			$(this).parents('div.component-option').remove();
		});
		
		//click bottone da tastiera INVIO/ESC => AGGIUNGI/RIMUOVI OPZIONE (MODAL AGGIUNGI COMPONENTE)
		body.on('keyup', '.component-option-text', function (e) {
			switch (e.keyCode) {
				case 13:
					//TASTO INVIO
					$('#component-options-items').append(`
						<div class="input-group input-group-sm mb-1 component-option">
							<input type="text" class="form-control component-option-text">
							<div class="input-group-append">
								<button class="btn btn-outline-secondary component-option-remove" type="button">
									<i class="fas fa-times fa-fw"></i>
								</button>
							</div>
						</div>
					`);
					$(this).parent().next('div.component-option').find('input.component-option-text').focus();
					break;
				case 27:
					//TASTO ESC
					$(this).parent().prev('div.component-option').find('input.component-option-text').focus();
					$(this).parents('div.component-option').remove();
					break;
			}
		});
		
		//click opzione select => MOSTRA PANNELLO TAB (COMPONENTI DISPONIBILI)
		body.on('change', '#available-components-select', function () {
			
			let code = $(this).find(':selected').data('id').toString();
			
			$('.tab-components').removeClass('show active');
			$('#' + code).addClass('show active');
		});
		
		//endregion
		
		//carica la lista dei componenti disponibili
		main.availableComponents = await main.getAvailableComponents();
	}
	
	/**
	 * Svuota tutte le righe dal modal di creazione righe
	 */
	private clearNewRow(): void {
		this.selector.add_row_content.empty();
	}
	
	/**
	 * Funzionamento logica modal di creazione righe
	 */
	private checkAddColumn(): void {
		let main = this,
			body = $('body');
		
		//prendo tutti i campi colonna
		let columns = body.find('.builder-new-column .modal-add-row-column-size');
		
		//totale campi
		let total_fields = columns.length;
		
		//totale campi compilati
		let notempty_fields = 0;
		columns.each(function () {
			if (String($(this).val()).length > 0) {
				notempty_fields++;
			}
		});
		
		//totale somma dei valori dei campi
		let total = 0;
		columns.each(function () {
			total += Number($(this).val());
		});
		
		//mostro/nascondo link "Aggiungi colonna"
		if (total_fields == notempty_fields && total < 12) {
			main.selector.add_row_add_column.show();
		} else {
			main.selector.add_row_add_column.hide();
		}
		
		//abilita/disabilita bottone "Salva" (nuova riga)
		if (total === 12) {
			$('#modal-add-row-save').removeAttr('disabled');
		} else {
			$('#modal-add-row-save').attr('disabled', 'disabled');
		}
		
		//mostra/nascondi bottone "Rimuovi colonna"
		if ($('.builder-column-save:visible').length > 0) {
			$('.modal-add-row-remove-column').hide();
		} else {
			$('.modal-add-row-remove-column').show();
		}
	}
	
	/**
	 * Aggiunge una nuova colonna nel modal di creazione righe
	 */
	private addNewColumn(): void {
		let main = this,
			body = $('body'),
			output = '',
			uuid = Utils.uuid();
		
		output += `
			<div class="row builder-new-column" style="margin-bottom: 5px;">
				<div class="col-md-4">
					<span style="vertical-align: -6px;">
						Colonna <span class="builder-new-column-iteration"></span>
					</span>
				</div>
				<div class="col-md-6">
					<select class="form-control full-width modal-add-row-column-size" data-uuid="${uuid}" autocomplete="off">
						<option></option>
						${main.buildOptions()}
					</select>
					<span class="label label-info builder-column-size-label" style="display: none;vertical-align: -6px;">
						Span: <span class="builder-column-size-text"></span>
					</span>
				</div>
				<div class="col-md-2 text-right">
					<i class="fas fa-times-circle cursor-pointer modal-add-row-remove-column"
					style="vertical-align: -6px;display: none;"></i>
					<button class="btn btn-info btn-xs builder-column-save" style="vertical-align: -6px;">
						Salva
					</button>
				</div>
			</div>
		`;
		
		main.selector.add_row_content.append(output);
		
		body.find(`.modal-add-row-column-size[data-uuid="${uuid}"]`).select2({
			placeholder: 'Seleziona dimensione...',
			dropdownParent: $('#modal-add-row')
		});
		
		main.refreshColumnsLabel();
		main.checkAddColumn();
	}
	
	/**
	 * Popola select span nuova colonna nel modal di creazione righe
	 * @param {any} selected
	 * @return {string}
	 */
	private buildOptions(selected = null): string {
		let body = $('body');
		
		//prendo tutti i campi colonna
		let columns = body.find('.builder-new-column .modal-add-row-column-size');
		
		//totale somma dei valori dei campi
		let total = 0;
		columns.each(function () {
			total += Number($(this).val());
		});
		
		let output = '';
		for (let i = 1; i <= 12 - total; i++) {
			output += `<option value="${i}" ${selected === i ? 'selected' : ''}>Span ${i}</option>`;
		}
		return output;
	}
	
	/**
	 * Aggiorna il numero del label della colonna nel modal di creazione righe
	 */
	private refreshColumnsLabel(): void {
		$('.builder-new-column').each(function (index) {
			$(this).find('.builder-new-column-iteration').html(String(index + 1));
		});
	}
	
	/**
	 * Ottiene i dati della nuova riga del modal di creazione righe
	 */
	private getNewRow(): { total: number, columns: number[] } {
		let columns = $('body').find('.builder-new-column .modal-add-row-column-size');
		let values = [];
		
		//totale somma dei valori dei campi
		let total: number = 0;
		columns.each(function () {
			total += Number($(this).val());
			values.push(Number($(this).val()));
		});
		
		return {
			total: total,
			columns: values
		};
	}
	
	/**
	 * Ottiene il componente disponibile tramite il suo codice
	 * @param {string} code
	 * @return {IAvailableComponent}
	 */
	private getAvailableComponentByCode(code: string): IAvailableComponent {
		return this.availableComponents.find(x => x.code == code);
	}
	
	/**
	 * Verifica che la posizione sia valida
	 * @param n
	 * @return {boolean}
	 */
	private isPositionValid(n): boolean {
		let main = this,
			index = 0;
		
		for (let i in main.currentComponents) {
			let row = main.currentComponents[i];
			index += row.length;
		}
		
		if (index === 0) {
			return false;
		}
		
		return n >= 1 && n <= index;
	}
	
	/**
	 * Restituisce gli indici
	 * @param {number} n
	 * @return {row:number, col:number}
	 */
	private getColumnFromPosition(n: number): { row: number, col: number } {
		let main = this,
			index = 0;
		
		for (let i in main.currentComponents) {
			let row = main.currentComponents[i];
			
			for (let j in row) {
				index++;
				
				if (n === index) {
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
	}
	
	/**
	 * Compone l'url col dominio admin
	 * @param {string} url
	 * @return {string}
	 */
	private admin_url(url: string): string {
		return `${admin_panel_url}/${url}`;
	}
	
	//endregion
	
	//region RICHIESTE AJAX
	
	/**
	 * Ottiene tutti i componenti disponibili
	 * @return {Promise<void>}
	 */
	private getAvailableComponents(): Promise<IAvailableComponent[]> {
		let main = this;
		return new Promise<IAvailableComponent[]>(function (resolve, reject) {
			$.ajax({
				cache: false,
				type: 'GET',
				url: main.admin_url(main.routes.availableComponents),
				success: function (data) {
					resolve(data);
				},
				error: function (xhr) {
					FormUtils.sendNotifications(xhr);
					reject(xhr.responseText);
				}
			});
		});
	}
	
	/**
	 * Ottiene tutti i componenti del form corrente
	 * @return {Promise<void>}
	 */
	private getFormComponents(): Promise<IFormComponent[][]> {
		let main = this;
		return new Promise<IFormComponent[][]>(function (resolve, reject) {
			$.ajax({
				cache: false,
				type: 'GET',
				url: main.admin_url(main.routes.formComponents + (main.isCurrentFormStatic ? '' : `/${main.currentForm}`)),
				success: function (data) {
					resolve(data);
				},
				error: function (xhr) {
					FormUtils.sendNotifications(xhr);
					reject(xhr.responseText);
				}
			});
		});
	}
	
	/**
	 * Salva tutti i componenti del form corrente
	 * @return {Promise<void>}
	 */
	private saveForm(): Promise<void> {
		let main = this;
		return new Promise<void>(function (resolve, reject) {
			$.ajax({
				cache: false,
				type: 'POST',
				url: main.admin_url(main.routes.saveForm),
				contentType: 'application/json',
				data: JSON.stringify({
					form: main.currentForm,
					data: main.currentComponents
				}),
				success: function (data) {
					resolve(data);
				},
				error: function (xhr) {
					FormUtils.sendNotifications(xhr);
					reject(xhr.responseText);
				}
			});
		});
	}
	
	//endregion
	
	//region RENDERING
	
	/**
	 * Renderizza i componenti disponibili
	 * @param {JQuery} selector
	 * @param {Array<IAvailableComponent>} items
	 */
	private renderAvailableComponents(selector: JQuery, items: Array<IAvailableComponent>) {
		let render = '';
		
		render += `<div class="list-group list-group-thin list-available-components">`;
		for (let i in items) {
			let item = items[i];
			render += `
				<a href="#" class="list-group-item list-group-item-action available-component"
				data-code="${item.code}">
					${item.description}
				</a>
			`;
		}
		render += `</div>`;
		selector.html(render);
	}
	
	/**
	 * Renderizza i componenti del form (GRIGLIA)
	 */
	private renderGrid() {
		let main = this,
			output = '',
			grid = $('#builder-grid');
		
		let index = 0;
		
		if (main.currentComponents.length > 0) {
			grid.empty();
			
			for (let i in main.currentComponents) {
				let row = main.currentComponents[i];
				
				output += `
					<div class="row mb-3 builder-row" style="padding: 0 25px;position: relative;"
					data-index="${i}">
					<i class="fas fa-ellipsis-v fa-fw builder-sort-row"></i>
				`;
				
				for (let j in row) {
					let column = row[j];
					let component_option = main.getAvailableComponentByCode(column.code);
					index++;
					
					output += `
						<div class="col-md-${column.span} builder-column cursor-move noselect" data-index="${j}">
							<div class="builder-column ${column.hasOwnProperty('code') ? 'bg-light' : 'bg-warning'}" style="min-height: 35px;border: solid 1px #f0f0f0;position: relative;text-align: center;">
								<span style="position: absolute;left: 0;right: 0;margin: 0 auto;font-weight: bold;line-height: 31px;">
									${column.hasOwnProperty('code') ?
						(column.hasOwnProperty('description') ? column.description : component_option.description) : 'Posizione ' + index}
								</span>
								`;
					
					if (column.hasOwnProperty('code')) {
						output += `
							<i class="fas fa-times fa-fw cursor-pointer builder-remove-component"
							data-row="${i}" data-col="${j}" title="Elimina componente"></i>
						`;
					}
					
					output += `
							</div>
						</div>
					`;
				}
				
				output += `
						<i class="fas fa-trash fa-fw cursor-pointer builder-remove-row"
						title="Elimina riga"></i>
					</div>
				`;
			}
			
			grid.append(output);
			
		} else {
			grid.html(`<h4 class="mt-0">Crea una nuova riga per iniziare</h4>`);
		}
		
		//aggiorno select posizione
		let options = '';
		options += `<option></option>`;
		
		index = 0;
		for (let i in main.currentComponents) {
			let row = main.currentComponents[i];
			
			for (let j in row) {
				let col = row[j];
				index++;
				
				if (!col.hasOwnProperty('code')) {
					
					options += `<option value="${index}">Posizione ${index}</option>`;
					
				}
			}
		}
		$('#component-position').html(options).trigger('change');
		main.onRenderGrid();
	}
	
	//endregion
	
	//region EVENTI SCATENATI DALLA CLASSE
	
	/**
	 * Scatenato al completamento del rendering dei componenti nel form
	 */
	private onRenderGrid() {
		let main = this;
		let rows = $('.builder-row');
		
		//distruggo sortable se già instanziato
		if (rows.sortable('instance') !== undefined) {
			rows.sortable('destroy');
		}
		
		//attivo sortable alle colonne delle righe
		rows.sortable({
			items: "> .builder-column",
			cursor: 'move',
			opacity: 0.8,
			handle: '.builder-column',
			placeholder: 'builder-placeholder-row',
			helper: function (e, tr: any) {
				let $originals = tr.children();
				let $helper = tr.clone();
				$helper.children().each(function (index) {
					$(this).width($originals.eq(index).width());
					$(this).width($originals.eq(index).width());
				});
				return $helper;
			},
			start: function (event, ui) {
				ui.placeholder.html('Rilascia qui');
			},
			update: function () {
				
				//riga corrente
				let row = $(this);
				
				//indice riga corrente
				let rowIndex: number = Number(row.data('index'));
				
				//prendo gli indici correnti delle colonne
				let indexes: Array<number> = row.sortable('toArray', {
					attribute: 'data-index'
				}).map(x => Number(x));
				
				//riordino le righe dei componenti
				let form: Array<any> = [];
				indexes.forEach(function (item) {
					form.push(main.currentComponents[rowIndex][item]);
				});
				
				//riaggiorno gli indici
				row.children('div').each(function (index) {
					$(this)
						.removeAttr('data-index')
						.attr('data-index', index);
				});
				
				//salvo il nuovo oggetto
				main.currentComponents[rowIndex] = form;
			}
		});
	}
	
	/**
	 * Scatenato una volta impostata la variabile "availableComponents"
	 */
	private onAvailableComponentsSet() {
		let main = this;
		
		main.tabs.forEach(function (value) {
			main.renderAvailableComponents(
				$(`#tab-${value.id}`),
				main.availableComponents.filter(value.predicate)
			);
		});
	}
	
	/**
	 * Scatenato al cambiamento del currentForm
	 */
	private async onCurrentFormChange() {
		this.currentComponents = await this.getFormComponents();
	}
	
	/**
	 * Scatenato una volta impostata la variabile "currentComponents"
	 */
	private onCurrentComponentsSet() {
		this.renderGrid();
	}
	
	//endregion
	
}

//region INTERFACCE

export interface IRoutes {
	availableComponents: string;
	formComponents: string;
	saveForm: string;
}

export interface IAvailableComponent {
	code: string;
	preset: boolean;
	description: string;
	type: string;
	custom_label: boolean;
	options?: Array<IAvailableComponentOption>;
}

export interface IAvailableComponentOption {
	name: string;
	value: string;
	type: string;
}

export interface IFormComponent {
	code: string;
	description: string;
	span: string;
	ranktype?: number;
	options?: string[];
}

export interface ITab {
	id: string;
	title: string;
	predicate: (value: IAvailableComponent, index: number) => boolean;
}

//endregion

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
