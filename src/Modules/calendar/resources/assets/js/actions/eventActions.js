import axios from "axios";
import {NotificationManager} from "react-notifications";

export function newEvent(data) {
	return {
		type: 'EVENT_NEW',
		payload: data
	};
}

export function editEvent(data) {
	return {
		type: 'EVENT_EDIT',
		payload: data
	};
}

export function closeEvent(data) {
	return {
		type: 'EVENT_CLOSE',
		payload: null
	};
}

export function saveEvent(data) {
	
	return dispatch => {
		let path = null;
		switch(data.type) {
			case 'edit':
				path = `${data.type}/${data.id}`;
				break;
			case 'new':
				path = `${data.type}`;
				break;
			default:
				path = `${data.type}`;
				break;
		}
		
		dispatch({
			type: 'SHOW_LOADER',
			payload: true
		});
		
		axios.post(`${location.href}/${path}`, {...data})
			.then(response => {
				dispatch({
					type: 'EVENT_SAVE',
					payload: data
				});
				NotificationManager.success('Success!');
			})
			.catch(error => {
				for(let i in error.response.data.errors) {
					NotificationManager.error(error.response.data.errors[i][0]);
				}
			})
			.then(() => {
				dispatch({
					type: 'SHOW_LOADER',
					payload: false
				});
			});
	};
	
	/*return {
		type: 'EVENT_SAVE',
		payload: data
	};*/
}

export function showLoader(data) {
	return {
		type: 'SHOW_LOADER',
		payload: data
	};
}
