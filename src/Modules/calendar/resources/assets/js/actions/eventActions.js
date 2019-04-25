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
