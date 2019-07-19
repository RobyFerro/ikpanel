import axios from 'axios';

export function getMainMenuItems(data) {
	return dispatch => {
		axios.get('/admin/navigation')
			.then(response => {
				dispatch({
					type: 'SET_MENU_ITEM',
					payload: response.data
				});
			})
			.catch(err => {
				console.error(err);
			});
	};
}

export function handleCondensedItems(index){
	return {
		type: 'HANDLE_CONDENSED_ITEMS',
		payload: index
	}
}