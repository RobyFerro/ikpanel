import React, {Component} from 'react';
import {Button, Modal} from "react-bootstrap";
import Datepicker from './Datepicker';
import {ModernGuiLoader} from './ModernGuiLoader';
import CKEditor from 'ckeditor4-react';
import InputMask from 'react-input-mask';
import {InputGroup} from './InputGroup';
import moment from 'moment';


class Event extends Component {
	
	constructor(props) {
		super(props);
		this.handleDateChange.bind(this);
		this.handleContentChange.bind(this);
		this.handleTitleChange.bind(this);
		this.handleAllDayChange.bind(this);
		this.renderEventDuration.bind(this);
		this.renderAllDayChecked.bind(this);
		this.showModalTitle.bind(this);
		this.handleSave.bind(this);
		
		this.state = {
			event: {
				title: this.props.title,
				date: this.props.data,
				content: this.props.content,
				type: this.props.type,
				startTime: this.props.startTime,
				stopTime: this.props.stopTime,
				location: this.props.location,
				allDay: this.props.allDay
			}
		};
		
	}
	
	componentWillReceiveProps(nextProps, nextContext) {
		this.setState({
			...this.state,
			event: {
				title: nextProps.title,
				date: nextProps.data,
				content: nextProps.content,
				type: nextProps.type,
				startTime: moment(nextProps.startTime).format('HH:mm'),
				stopTime: moment(nextProps.stopTime).format('HH:mm'),
				location: nextProps.location,
				allDay: nextProps.allDay
			}
		});
	}
	
	handleAllDayChange = () => {
		this.setState({
			...this.state,
			event: {
				...this.state.event,
				allDay: !this.state.event.allDay
			}
		});
	};
	
	handleDateChange = (value) => {
		this.setState({
			...this.state,
			event: {
				...this.state.event,
				date: value
			}
		});
	};
	
	handleContentChange = (event) => {
		this.setState({
			...this.state,
			event: {
				...this.state.event,
				content: event.editor.getData()
			}
		});
	};
	
	handleTitleChange = (event) => {
		this.setState({
			...this.state,
			event: {
				...this.state.event,
				title: event.target.value
			}
		});
	};
	
	handleStartTimeChange = (event) => {
		this.setState({
			...this.state,
			event: {
				...this.state.event,
				startTime: event.target.value
			}
		});
	};
	
	handleStopTimeChange = (event) => {
		this.setState({
			...this.state,
			event: {
				...this.state.event,
				stopTime: event.target.value
			}
		});
	};
	
	handleLocationChange = (event) => {
		this.setState({
			...this.state,
			event: {
				...this.state.event,
				location: event.target.value
			}
		});
	};
	
	renderEventDuration = () => {
		if(!this.state.event.allDay) {
			return (
				<div className="row pt-3">
					<div className="col-md-6">
						<InputGroup label="Start">
							<InputMask mask="99:99"
							           onChange={this.handleStartTimeChange}
							           className="form-control"
							           value={this.state.event.startTime}/>
						</InputGroup>
					</div>
					<div className="col-md-6">
						<InputGroup label="Stop">
							<InputMask mask="99:99"
							           onChange={this.handleStopTimeChange}
							           value={this.state.event.stopTime}
							           className="form-control"/>
						</InputGroup>
					</div>
				</div>
			);
		}
	};
	
	renderAllDayChecked = () => {
		if(this.state.event.allDay) {
			return (
				<input type="checkbox" value={this.state.event.allDay} id="allDay" checked={'checked'} onChange={this.handleAllDayChange}/>
			);
		} else {
			return (
				<input type="checkbox" value={this.state.event.allDay} id="allDay" checked={''}  onChange={this.handleAllDayChange}/>
			);
		}
	};
	
	showModalTitle = () => {
		switch(this.state.event.type) {
			case 'new':
				return <h1>New event</h1>;
			case 'edit':
				return <h1>Edit event {this.state.event.title}</h1>;
		}
	};
	
	handleSave = () => {
		this.props.save(this.state.event);
	};
	
	render() {
		return (
			<div>
				<Modal show={this.props.show} onHide={() => this.props.closeModal()} size="xl">
					<Modal.Header closeButton>
						<Modal.Title>
							{this.showModalTitle()}
						</Modal.Title>
					</Modal.Header>
					<Modal.Body>
						<div className="row pt-3">
							<div className="col-md-6">
								<Datepicker title={'Event date'}
								            selectedDate={this.props.data}
								            onChange={this.handleDateChange}/>
							</div>
							<div className="col-md-6">
								<InputGroup label={'Title'}>
									<input type="text"
									       className="form-control"
									       autoComplete="off"
									       onChange={this.handleTitleChange}
									       value={this.state.event.title}/>
								</InputGroup>
							</div>
						</div>
						{this.renderEventDuration()}
						<div className="row pt-3">
							<div className="col-md-12">
								<InputGroup label='Location'>
									<input type="text"
									       className="form-control"
									       autoComplete="off"
									       onChange={this.handleLocationChange}
									       value={this.state.event.location}/>
								</InputGroup>
							</div>
						</div>
						<div className="row pt-3">
							<div className="col-md-12">
								<div className="checkbox check-default">
									{this.renderAllDayChecked()}
									<label htmlFor="allDay">All day</label>
								</div>
							</div>
						</div>
						<div className="row pt-3">
							<div className="col-md-12">
								<CKEditor data={this.props.content} onChange={this.handleContentChange}/>
							</div>
						</div>
					</Modal.Body>
					<Modal.Footer>
						<Button variant="secondary" onClick={() => this.props.closeModal()}>
							Close
						</Button>
						<Button variant="primary" onClick={this.handleSave}>
							Save
						</Button>
					</Modal.Footer>
				</Modal>
				<ModernGuiLoader show={this.props.loader} message={'Loading...'}/>
			</div>
		);
	}
}

export default Event;

