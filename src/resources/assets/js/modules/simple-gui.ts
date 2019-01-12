import ModernGUI from "./modern-gui";
import IPP from "./tools/items-in-page"

declare let admin_panel_url: any;
declare let sendNotifications: any;

export default class SimpleGui {
	
	table: string = null;
	statusFilter: string = null;
	searchFilter: string = null;
	filterUrlPrefix: string = null;
	itemInTable: number = null;
	itemInTableInput: string = null;
	resultContainer: string = null;
	saveOrder: boolean = false;
	sort: boolean = true;
	stateSave: boolean = false;
	
	// Pulsanti azione
	actionButtonDelete: string = null;
	actionButtonRestore: string = null;
	
	// Messaggi
	actionDeleteMessage: string = null;
	actionDeleteQuestion: string = null;
	actionRestoreMessage: string = null;
	actionRestoreQuestion: string = null;
	
	
	init() {
		let main = this,
			statusFilter = $(this.statusFilter),
			searchFilter = $(this.searchFilter),
			resultContainer = $(this.resultContainer),
			tableName = $(this.table),
			body = $('body'),
			ipp = null;
		
		if (main.saveOrder) {
			let sortable = tableName.find('tbody').sortable({
				items: "> tr",
				cursor: 'move',
				opacity: 0.8,
				handle: '.handle',
				helper: function (e, tr: any) {
					let $originals = tr.children();
					let $helper = tr.clone();
					$helper.children().each(function (index) {
						$(this).width($originals.eq(index).width());
						$(this).width($originals.eq(index).width());
					});
					return $helper;
				},
				update: function (event, ui) {
					let parameters = sortable.sortable('toArray', {attribute: 'data-id'});
					let start = tableName.DataTable().page.info().start;
					let items = [];
					for (let key in parameters) {
						let item = {};
						item['id'] = Number(parameters[key]);
						item['order'] = Number(key) + Number(start) + 1;
						items.push(item);
					}
					
					$.ajax({
						type: 'PUT',
						contentType: 'application/json',
						url: `${admin_panel_url}/${main.filterUrlPrefix}/update-order`,
						data: JSON.stringify({items: items}),
						success: function (data) {
						},
						error: function (xhr) {
							sendNotifications(xhr);
						},
						beforeSend: function () {
						},
						complete: function () {
						}
					});
				}
			});
		}
		
		let table = tableName.DataTable(main.getDataTableSettings());
		statusFilter.select2();
		searchFilter.triggerHandler('focus');
		
		$('[data-toggle=tip]').tooltip({
			container: 'body',
			placement: 'left'
		});
		
		if (main.itemInTableInput !== null) {
			ipp = new IPP('#item-per-page-skills', 'ipp-skills');
			ipp.on('change', function (value) {
				table.page.len(value).draw();
			});
		}
		
		// Filtro ricerca
		body.on('keyup', main.searchFilter, function () {
			let terms = String(searchFilter.val());
			table.search(terms).draw();
			
			if (main.saveOrder) {
				if (terms.length > 0) {
					table.column(0).visible(false);
				} else {
					table.column(0).visible(true);
				}
				table.columns.adjust().draw();
			}
		});
		
		// Cambio status
		body.on('change', this.statusFilter, function () {
			let term = String(statusFilter.val());
			
			$.ajax({
				type: 'GET',
				url: `${admin_panel_url}/${main.filterUrlPrefix}/filter/${term}`,
				success: function (data) {
					
					resultContainer.html(data);
					table = tableName.DataTable(main.getDataTableSettings());
					table.search(term);
					
					$('[data-toggle=tip]').tooltip({
						container: 'body',
						placement: 'left'
					});
				},
				error: function (xhr) {
					sendNotifications(xhr);
				},
				beforeSend: function () {
					table.clear();
					table.destroy();
					ModernGUI.loading(true);
				},
				complete: function () {
					ModernGUI.loading(false);
				}
			});
			
		});
		
		// Rimuovo oggetto
		body.on('click', this.actionButtonDelete, async function () {
			let itemID = $(this).data('id');
			if (await ModernGUI.confirm(main.actionDeleteQuestion)) {
				$.ajax({
					type: 'DELETE',
					contentType: 'application/json',
					url: `${admin_panel_url}/${main.filterUrlPrefix}/delete/${itemID}`,
					success: function () {
						location.reload();
					},
					error: function (xhr) {
						sendNotifications(xhr);
					},
					beforeSend: function () {
						ModernGUI.loading(true, main.actionDeleteMessage);
					},
					complete: function () {
						ModernGUI.loading(false);
					}
				});
			}
			
		});
		
		// Ripristino oggetto
		body.on('click', this.actionButtonRestore, async function () {
			let itemID = $(this).data('id');
			if (await ModernGUI.confirm(main.actionRestoreQuestion)) {
				$.ajax({
					type: 'PUT',
					contentType: 'application/json',
					url: `${admin_panel_url}/${main.filterUrlPrefix}/restore/${itemID}`,
					success: function () {
						location.reload();
					},
					error: function (xhr) {
						sendNotifications(xhr);
					},
					beforeSend: function () {
						ModernGUI.loading(true, main.actionRestoreMessage);
					},
					complete: function () {
						ModernGUI.loading(false);
					}
				});
			}
		});
	}
	
	private getDataTableSettings() {
		let main = this;
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
			iDisplayLength: main.itemInTable,
		};
	}
}