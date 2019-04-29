import React, {Component} from 'react';
import Event from '../components/Event';
import {connect} from 'react-redux';
import {newEvent, editEvent, closeEvent, saveEvent, showLoader} from "../actions/eventActions";
import FullCalendar from '@fullcalendar/react';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from '@fullcalendar/interaction';
import Fade from 'react-reveal/Fade';
import axios from 'axios';
import {NotificationContainer, NotificationManager} from 'react-notifications';

import 'react-notifications/lib/notifications.css';
import '../../sass/main.scss';

class Calendar extends Component {
	
	calendarComponentRef = React.createRef();
	
	constructor(props) {
		super(props);
		/*TODO: Retrieve data from web server*/
		this.state = {
			calendar: {
				options: {
					defaultView: "dayGridMonth",
					header: {
						right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek today prev,next'
					},
					events: `${location.href}/events`,
				}
			}
		};
	}
	
	render() {
		return (
			<div>
				<Fade>
					<FullCalendar plugins={[dayGridPlugin, timeGridPlugin, interactionPlugin]}
					              eventClick={this.props.editEvent}
					              ref={this.calendarComponentRef}
					              dateClick={this.props.newEvent}
					              {...this.state.calendar.options} />
					<Event show={this.props.event.showModal}
					       data={this.props.event.eventData.date}
					       content={this.props.event.eventData.content}
					       title={this.props.event.eventData.title}
					       allDay={this.props.event.eventData.allDay}
					       startTime={this.props.event.eventData.startTime}
					       stopTime={this.props.event.eventData.stopTime}
					       location={this.props.event.eventData.location}
					       type={this.props.event.type}
					       loader={this.props.event.loading}
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
			dispatch(closeEvent(data));
		},
		saveEvent: (data) => {
			dispatch(showLoader(true));
			axios.post(`${location.href}/${data.type}`, {data})
				.then(response => {
					dispatch(saveEvent(data));
					NotificationManager.success('Success!');
				})
				.catch(error => {
					NotificationManager.error(error);
				})
				.then(() => {
					dispatch(showLoader(false));
				});
		}
	};
};

export default connect(mapStateToProps, mapDispatchToProps)(Calendar);
