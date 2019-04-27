import React, {Component} from 'react';
import FullCalendar from '@fullcalendar/react';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import Event from '../components/Event';
import {connect} from 'react-redux';
import {newEvent, editEvent, closeEvent, saveEvent} from "../actions/eventActions";
import Fade from 'react-reveal/Fade';
import axios from 'axios';
import {NotificationContainer, NotificationManager} from 'react-notifications';
import 'react-notifications/lib/notifications.css';
import '../../sass/main.scss';

class Calendar extends Component {
	
	constructor(props) {
		super(props);
		/*TODO: Retrieve data from web server*/
		this.state = {
			events: [
				{title: 'event 1', date: '2019-04-01'},
				{title: 'event 2', date: '2019-04-02'}
			]
		};
	}
	
	render() {
		return (
			<div>
				<Fade>
					<FullCalendar dateClick={this.props.newEvent}
					              eventClick={this.props.editEvent}
					              events={this.state.events}
					              plugins={[dayGridPlugin, interactionPlugin]}/>
					<Event show={this.props.event.showModal}
					       data={this.props.event.eventData.date}
					       content={this.props.event.eventData.content}
					       title={this.props.event.eventData.title}
					       type={this.props.event.type}
					       loader={this.state.loading}
					       save={this.props.saveEvent}
					       closeModal={() => this.props.closeEvent()}/>
				</Fade>
				<NotificationContainer/>
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
			console.log('closing');
			dispatch(closeEvent(data));
		},
		saveEvent: (data) => {
			axios.post(`${location.href}/${data.type}`, {data})
				.then(response => {
					dispatch(saveEvent(data));
					NotificationManager.success('Success!');
				})
				.catch(error => {
					NotificationManager.error(error);
				});
		}
	};
};

export default connect(mapStateToProps, mapDispatchToProps)(Calendar);
