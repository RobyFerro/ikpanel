import {createStore, combineReducers, applyMiddleware} from 'redux';
import thunk from 'redux-thunk';
import navReducer from "./reducers/navReducer";

export default createStore(
	combineReducers({
		navigation: navReducer
	}),
	{
		navigation: {
			navItem: []
		}
	},
	applyMiddleware(thunk)
);