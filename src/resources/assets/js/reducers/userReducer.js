const userReducer = (state = {}, action) => {
		switch(action.type) {
			case 'GET_USERS':
				state = {
					...state,
					list: action.payload,
					isLoading: false
				};
				break;
			case 'REMOVE_USER':
				state = {
					...state,
					list: state.list.filter(item => (item.id !== action.payload)),
					isLoading: false
				};
				break;
		}
		
		return state;
	}
;

export default userReducer;