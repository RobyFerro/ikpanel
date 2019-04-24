import React, {Component} from 'react';
import FullCalendar from '@fullcalendar/react';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import {Modal, Button} from 'react-bootstrap';
import moment from 'moment';
import '../../sass/main.scss';

class Calendar extends Component {
	
	constructor(props) {
		super(props);
		this.handleDateClick.bind(this);
		this.handleModalHide.bind(this);
	}
	
	state = {
		modalShow: false,
		selectedDate: null
	};
	
	handleDateClick = (arg) => {
		this.setState({
			modalShow: true,
			selectedDate: moment(arg.date).format('DD/MM/YYYY')
		});
	};
	
	handleModalHide = () => {
		this.setState({modalShow: false});
	};
	
	render() {
		return (
			<div>
				<FullCalendar dateClick={this.handleDateClick} plugins={[dayGridPlugin, interactionPlugin]}/>
				<Modal show={this.state.modalShow} onHide={this.handleModalHide}>
					<Modal.Header closeButton>
						<Modal.Title>Modal heading</Modal.Title>
					</Modal.Header>
					<Modal.Body>
						<p>{this.state.selectedDate}</p>
					</Modal.Body>
					<Modal.Footer>
						<Button variant="secondary" onClick={this.handleModalHide}>
							Close
						</Button>
						<Button variant="primary" onClick={this.handleModalHide}>
							Save Changes
						</Button>
					</Modal.Footer>
				</Modal>
			</div>
		);
	}
	
}

export default Calendar;
