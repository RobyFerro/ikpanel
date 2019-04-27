import React, {Component} from 'react';
import {Modal} from "react-bootstrap";


export const ModernGuiLoader = (props) => {
	return (
		<Modal show={props.show} className="modal fade fill-in" data-backdrop="static" data-keyboard="false"
		       tabIndex="-1">
			<Modal.Body style={{textAlign: 'center'}}>
				<i className="fas fa-circle-notch fa-spin fa-5x fa-fw"/>
				<h2>{props.message}</h2>
			</Modal.Body>
		</Modal>
	);
};

