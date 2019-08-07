import { applyMiddleware, combineReducers, createStore } from 'redux'
import thunk from 'redux-thunk'
import navReducer from './reducers/navReducer'
import userReducer from './reducers/userReducer'

export default createStore(
  combineReducers({
    navigation: navReducer,
    users: userReducer
  }),
  {
    navigation: {
      navItem: []
    },
    users: {
      list: [],
      isLoading: true
    }
  },
  applyMiddleware(thunk)
)