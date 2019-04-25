import moment from 'moment';

const eventReducer = (state = {
	showModal: false,
	selectedDate: null
}, action) => {
	switch(action.type) {
		case 'EVENT_NEW':
			state = {
				...state,
				showModal: true,
				selectedDate: moment(action.payload.date).format('DD/MM/YYYY'),
				title:'New event'
			};
			break;
		case 'EVENT_EDIT':
			state = {
				...state,
				showModal: true,
				selectedDate: action.payload,
				title:'Edit event'
			};
			break;
		case 'EVENT_CLOSE':
			state = {
				...state,
				showModal: false,
				selectedDate: null,
				title:null,
			};
	}
	
	return state;
};

export default eventReducer;
