import React, {Component} from 'react';
import {Button, Modal} from "react-bootstrap";
import Datepicker from './Datepicker';
import {ModernGuiLoader} from './ModernGuiLoader';
import CKEditor from 'ckeditor4-react';


class Event extends Component {
	
	constructor(props) {
		super(props);
		this.handleDateChange.bind(this);
		this.handleContentChange.bind(this);
		this.handleTitleChange.bind(this);
		this.showModalTitle.bind(this);
		this.handleSave.bind(this);
		
		this.state = {
			event: {
				title: this.props.title,
				date: this.props.data,
				content: this.props.content,
				type: this.props.type
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
				type: nextProps.type
			}
		});
	}
	
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
				<Modal show={this.props.show} onHide={() => this.props.closeModal()} size="lg">
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
								<div className="form-group form-group-default input-group">
									<div className="form-input-group">
										<label htmlFor="title">Title</label>
										<input type="text"
										       className="form-control"
										       autoComplete="off"
										       onChange={this.handleTitleChange}
										       value={this.state.event.title}/>
									</div>
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

