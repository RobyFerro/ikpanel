import moment from 'moment';

const eventReducer = (state = {
	showModal: false,
	selectedDate: null
}, action) => {
	switch(action.type) {
		case 'EVENT_NEW':
			state = {
				...state,
				type: 'new',
				showModal: true,
				title: 'New event',
				eventData: {
					title: '',
					date: moment(action.payload.date).format('DD/MM/YYYY'),
					content: ''
				},
			};
			break;
		case 'EVENT_EDIT':
			state = {
				...state,
				type: 'edit',
				showModal: true,
				title: 'Edit event',
				eventData: {
					title: action.payload.event.title,
					date: moment(action.payload.event.start).format('DD/MM/YYYY'),
					content: null
				},
			};
			break;
		case 'EVENT_CLOSE':
			state = {
				...state,
				type: null,
				showModal: false,
				title: null,
				eventData: {
					title: '',
					date: null,
					content: ''
				},
			};
			break;
		case 'EVENT_SAVE':
			state = {
				...state,
				type: null,
				showModal: false,
				eventData: {
					title: '',
					date: '',
					content: ''
				}
			};
			break;
		case 'SHOW_LOADER':
			state = {
				...state,
				loading: action.payload
			};
	}
	
	return state;
};

export default eventReducer;
