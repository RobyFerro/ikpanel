import React, {Component} from 'react';
import FullCalendar from '@fullcalendar/react';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import {Event} from '../components/Event';
import {connect} from 'react-redux';
import {newEvent, editEvent, closeEvent} from "../actions/eventActions";
import Fade from 'react-reveal/Fade';
import '../../sass/main.scss';

class Calendar extends Component {
	
	render() {
		return (
			<div>
				<Fade>
					<FullCalendar dateClick={this.props.newEvent}
					              plugins={[dayGridPlugin, interactionPlugin]}/>
					<Event show={this.props.event.showModal}
					       data={this.props.event.selectedDate}
					       title={this.props.event.title}
					       closeModal={() => this.props.closeEvent()}/>
				</Fade>
			</div>
		);
	}
	
}

const mapStateToProps = (state) => {
	return {
		event: state.event
	};
};

const mapDispatchToProps = (dispatch) => {
	return {
		newEvent: (data) => {
			dispatch(newEvent(data));
		},
		editEvent: (data) => {
			dispatch(editEvent(data));
		},
		closeEvent: (data) => {
			dispatch(closeEvent(data));
		}
	};
};

export default connect(mapStateToProps, mapDispatchToProps)(Calendar);
