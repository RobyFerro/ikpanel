import React from 'react';
import {Button, Modal} from "react-bootstrap";
import Datepicker from './Datepicker';

export const Event = (props) => {
	return (
		<div>
			<Modal show={props.show} onHide={() => props.closeModal()} size="lg">
				<Modal.Header closeButton>
					<Modal.Title>
						{props.title}
					</Modal.Title>
				</Modal.Header>
				<Modal.Body>
					<h4>{props.data}</h4>
					<Datepicker title={'Test'} selectedDate={props.data}/>
				</Modal.Body>
				<Modal.Footer>
					<Button variant="secondary" onClick={() => props.closeModal()}>
						Close
					</Button>
					<Button variant="primary" onClick={() => props.closeModal()}>
						Save Changes
					</Button>
				</Modal.Footer>
			</Modal>
		</div>
	);
};
