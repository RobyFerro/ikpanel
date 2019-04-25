import React from 'react';
import {Button, Modal} from "react-bootstrap";

export const Event = (props) => {
	return (
		<div>
			<Modal show={props.show} onHide={() => props.closeModal()} size="lg">
				<Modal.Header closeButton>
					<Modal.Title>Modal heading</Modal.Title>
				</Modal.Header>
				<Modal.Body>
					<h4>{props.data}</h4>
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
