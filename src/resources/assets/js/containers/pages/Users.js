import React, {Component} from 'react';
import MaterialTable from 'material-table';
import {Paper} from "@material-ui/core";
import {getUsers} from "../../actions/userActions";
import {connect} from "react-redux";
import Button from '@material-ui/core/Button';
import Breadcrumbs from '@material-ui/core/Breadcrumbs';
import Link from '@material-ui/core/Link';
import {Link as RouterLink} from "react-router-dom";
import Typography from '@material-ui/core/Typography';

class Users extends Component {
	
	componentDidMount() {
		this.props.getUsers();
	}
	
	render() {
		return (
			<div>
				<Breadcrumbs aria-label="Breadcrumb" component='div'>
					<Link color="inherit" component={RouterLink} to='/'>
						#ikpanel
					</Link>
					<Typography color="textPrimary">Users</Typography>
				</Breadcrumbs>
				<Button variant="contained" style={{marginTop: 20, marginBottom: 20}}>New user</Button>
				<Paper>
					
					<MaterialTable style={{padding: 30}} title={'Users'} columns={
						[
							{title: "Name", field: "name"},
							{title: "Surname", field: "surname"},
							{title: "E-Mail", field: "email"}
						]} data={this.props.users.list} actions={[
						{
							icon: 'edit',
							tooltip: 'Edit user',
							onClick: (event, rowData) => console.log(rowData)
						},
						{
							icon: 'delete',
							tooltip: 'Remove user',
							onClick: (event, rowData) => console.log(rowData)
						}
					]}/>
				
				</Paper>
			</div>
		
		);
	}
	
}

const mapStateToProps = (state) => {
	return {
		users: state.users
	};
};

const mapDispatchToProps = (dispatch) => {
	return {
		getUsers: () => {
			dispatch(getUsers());
		}
	};
};

export default connect(mapStateToProps, mapDispatchToProps)(Users);