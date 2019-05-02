import {createStore, combineReducers, applyMiddleware} from 'redux';
import eventReducer from './reducers/eventReducer';
import thunk from 'redux-thunk';

export default createStore(
	combineReducers({event: eventReducer}),
	{
		event: {
			type: null,
			showModal: false,
			eventData: {
				title: '',
				date: null,
				dateEnd: null,
				content: null,
				startTime: '',
				stopTime: '',
				location: '',
				allDay: false
			},
			loading: false,
			willUpdate: false
		}
	},
	applyMiddleware(thunk)
);
