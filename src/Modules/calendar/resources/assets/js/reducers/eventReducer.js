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
					id: '',
					title: '',
					date: moment(action.payload.date).format('DD/MM/YYYY'),
					content: '',
					startTime: '',
					stopTime: '',
					location: '',
					allDay: false
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
					id: action.payload.event.id,
					title: action.payload.event.title,
					date: moment(action.payload.event.start).format('DD/MM/YYYY'),
					content: action.payload.event.extendedProps.content,
					startTime: action.payload.event.start,
					stopTime: action.payload.event.end,
					location: action.payload.event.extendedProps.location,
					allDay: action.payload.event.allDay
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
					id: '',
					title: '',
					date: null,
					content: '',
					startTime: '',
					stopTime: '',
					location: '',
					allDay: false
				},
			};
			break;
		case 'EVENT_SAVE':
			state = {
				...state,
				type: null,
				showModal: false,
				eventData: {
					id: '',
					title: '',
					date: '',
					content: '',
					startTime: '',
					stopTime: '',
					location: '',
					allDay: false
				},
				willUpdate: true
			};
			break;
		case 'SHOW_LOADER':
			state = {
				...state,
				loading: action.payload,
				willUpdate: false
			};
	}
	
	return state;
};

export default eventReducer;
