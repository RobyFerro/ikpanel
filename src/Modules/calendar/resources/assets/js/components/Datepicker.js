import React from 'react';
import {Component} from 'react';
import $ from 'jquery';
import 'bootstrap-datepicker/js/bootstrap-datepicker';
import moment from 'moment';

class Datepicker extends Component {
	
	componentWillMount() {
		return false;
	}
	
	componentWillReceiveProps(nextProps, nextContext) {
		this.datePicker.datepicker('update', this.props.selectedDate);
	}
	
	componentDidMount() {
		$.fn.datepicker.dates['it'] = {
			days: ["Domenica", "Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdì", "Sabato"],
			daysShort: ["Dom", "Lun", "Mar", "Mer", "Gio", "Ven", "Sab"],
			daysMin: ["Do", "Lu", "Ma", "Me", "Gi", "Ve", "Sa"],
			months: ["Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"],
			monthsShort: ["Gen", "Feb", "Mar", "Apr", "Mag", "Giu", "Lug", "Ago", "Set", "Ott", "Nov", "Dic"],
			today: "Oggi",
			monthsTitle: "Mesi",
			clear: "Cancella",
			weekStart: 1,
			format: "dd/mm/yyyy"
		};
		
		this.datePicker = $(this.refs.datePicker).datepicker({
			language: 'it',
			autoclose: true,
			orientation: "auto",
			weekStart: 1,
			todayBtn: true,
			todayHighlight: true
		});
		
		this.datePicker.datepicker('setDate', moment(this.props.selectedDate, 'DD/MM/YYYY').toDate());
	}
	
	render() {
		
		return (
			<div>
				<div className="form-group form-group-default input-group">
					<div className="form-input-group">
						<label htmlFor="birthday">{this.props.title}</label>
						<input type="text"
						       id={this.props.title}
						       ref="datePicker"
						       className="form-control form-data"
						       autoComplete="off"/>
					</div>
					<div className="input-group-addon">
						<i className="fas fa-calendar"/>
					</div>
				</div>
			</div>
		);
	}
}

export default Datepicker;
