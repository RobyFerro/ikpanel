const userReducer = (state = {}, action) => {
	switch(action.type) {
		case 'GET_USERS':
			state = {
				...state,
				list: action.payload
			};
			break;
	}
	
	return state;
};

export default userReducer;