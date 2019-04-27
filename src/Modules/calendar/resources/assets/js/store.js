import {createStore, combineReducers, applyMiddleware} from 'redux';
import eventReducer from './reducers/eventReducer';

export default createStore(
	combineReducers({event: eventReducer}),
	{
		event: {
			type: null,
			showModal: false,
			eventData: {
				title: '',
				date: null,
				content: null
			}
		}
	},
	applyMiddleware()
);
