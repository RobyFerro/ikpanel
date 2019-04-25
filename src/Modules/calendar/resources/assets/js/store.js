import {createStore, combineReducers, applyMiddleware} from 'redux';
import eventReducer from './reducers/eventReducer';

export default createStore(
	combineReducers({event: eventReducer}), {}, applyMiddleware()
);
