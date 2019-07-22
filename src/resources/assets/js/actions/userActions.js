import axios from 'axios';

export function getUsers() {
	return dispatch => {
		axios.get('/admin/react/get-users')
			.then(response => {
				dispatch({
					type: 'GET_USERS',
					payload: response.data
				});
			})
			.catch(err => {
				throw err;
			});
	};
}

export function removeUser(id) {
	return dispatch => {
		axios.delete(`/admin/users/delete/${id}`)
			.then(() => {
				dispatch({
					type: 'REMOVE_USER',
					payload: id
				});
			})
			.catch(err => {
				throw err;
			});
	};
}