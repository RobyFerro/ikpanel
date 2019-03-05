/*
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

import * as BaseWidgets from '../../templates/widget/base.hbs';
import * as WidgetTable from "../../templates/widget/table.hbs";
import * as Chart from "chart.js";

declare let admin_panel_url: string;

export default class Widgets {
	
	public Widgets;
	
	/**
	 * Load all role widget
	 */
	public init() {
		let main = this;
		
		$.ajax({
			type: "GET",
			async: false,
			url: `${admin_panel_url}/widgets/load`,
			success: function (data) {
				main.Widgets = data;
			}
		});
	}
	
	/**
	 * Create row
	 */
	public createRow() {
		let main = this,
			widgets = main.Widgets;
		
		for (let row in widgets) {
			$('.cards_container').append(BaseWidgets({rows: widgets[row], id: row}));
		}
	}
	
	/**
	 * Get all widget data
	 */
	public getWidgetContent() {
		let main = this,
			widgets = main.Widgets;
		
		for (let row in widgets) {
			for (let widget in widgets[row]) {
				
				let singleWidget = widgets[row][widget],
					container = `#widget-body-${singleWidget.id}`,
					type = singleWidget.id_category;
				
				$.ajax({
					type: "GET",
					url: `${admin_panel_url}/${singleWidget.path}`,
					success: function (data) {
						switch (type) {
							case "TABLE":
								$(container).append(WidgetTable(data));
								main.processTableElement(data.table_id);
								break;
							case "GRAPH":
								$(container).append(`<div class="graph-container" style="position:relative; height: 90%;"><canvas id="${data.graph_id}"></canvas></div>`);
								main.processGraph(data);
								break;
						}
					},
					error: function () {
						$(container).append("errore");
					},
					complete: function () {
						$(`#widget-${singleWidget.id} .widget-loader`).hide();
						$(`.widget-animation-${singleWidget.id}`).slideDown(200);
						$(container).animate({opacity: 1}, 300);
					}
				});
			}
		}
	}
	
	/**
	 * Create datatable and searchbox
	 * @param id
	 */
	private processTableElement(id: string) {
		let table = $(`#${id}`).DataTable({
			paging: false,
			info: false,
			dom: "<'table-responsive't><'row'<p i>>"
		});
		
		$(`#widget-search-${id}`).on('keyup', function () {
			table.search($(this).val().toString()).draw();
		})
	}
	
	/**
	 * Create graph
	 * @param data
	 */
	private processGraph(data) {
		new Chart(data.graph_id, {
			type: data.type,
			options: data.options,
			data: {
				labels: data.labels,
				datasets: [{
					data: data.data,
					backgroundColor: data.colors,
					label: data.dataset_labels
				}]
			}
		});
	}
}
