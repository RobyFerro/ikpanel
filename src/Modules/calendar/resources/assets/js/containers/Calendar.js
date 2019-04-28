import React, {Component} from 'react';
import FullCalendar from '@fullcalendar/react';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import Event from '../components/Event';
import {connect} from 'react-redux';
import {newEvent, editEvent, closeEvent, saveEvent, showLoader} from "../actions/eventActions";
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
				{
					title: 'event 1',
					date: '2019-04-01',
					extendedProps: {
						content: 'Ciao',
						start: '10:00',
						stop: '12:00',
						location: 'Bergamo'
					}
				},
				{
					title: 'event 2',
					date: '2019-04-02',
					extendedProps: {
						content: 'Ciao',
						start: '10:00',
						stop: '12:00',
						location: 'Bergamo'
					}
				}
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
			console.log('closing');
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
