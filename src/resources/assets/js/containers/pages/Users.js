import React, { Component } from 'react'
import MaterialTable from 'material-table'
import { Paper } from '@material-ui/core'
import { getUsers, removeUser } from '../../actions/userActions'
import { connect } from 'react-redux'
import Button from '@material-ui/core/Button'
import Breadcrumbs from '@material-ui/core/Breadcrumbs'
import Link from '@material-ui/core/Link'
import { Link as RouterLink } from 'react-router-dom'
import Typography from '@material-ui/core/Typography'
import Dialog from '@material-ui/core/Dialog'
import DialogActions from '@material-ui/core/DialogActions'
import DialogContent from '@material-ui/core/DialogContent'
import DialogContentText from '@material-ui/core/DialogContentText'
import DialogTitle from '@material-ui/core/DialogTitle'

class Users extends Component {

  constructor (props) {
    super(props)
    this.handleClickCloseModal.bind(this)
    this.handleClickOpenModal.bind(this)
    this.handleDeleteUser.bind(this)
    this.showRemoveConfirm.bind(this)
    this.state = {
      removeModal: false,
      selectedUser: null,
      isLoading: true
    }
  }

  componentDidMount () {
    this.props.getUsers()
  }

  componentDidUpdate (prevProps, prevState, snapshot) {
    if ((prevProps.users.isLoading !== this.props.users.isLoading) || (prevState.isLoading !== this.props.users.isLoading)) {
      this.setState({
        ...this.state,
        isLoading: this.props.users.isLoading
      })
    }
  }

  handleClickCloseModal = () => {
    this.setState({
      ...this.state,
      removeModal: false,
      selectedUser: null
    })
  }

  handleClickOpenModal = (user) => {
    this.setState({
      ...this.state,
      removeModal: true,
      selectedUser: user
    })
  }

  handleDeleteUser = () => {
    if (this.state.selectedUser !== null) {
      this.setState({
          ...this.state,
          isLoading: true,
          removeModal: false,
          selectedUser: null
        },
        this.props.removeUser(this.state.selectedUser.id))
    }
  }

  showRemoveConfirm = () => {
    return (
      <Dialog
        open={this.state.removeModal}
        onClose={this.handleClickCloseModal}
        aria-labelledby="alert-dialog-title"
        aria-describedby="alert-dialog-description">
        <DialogTitle
          id="alert-dialog-title">{
          this.state.selectedUser !== null ?
            `Remove user "${this.state.selectedUser.name} ${this.state.selectedUser.surname}"` :
            'Remove user'
        }
        </DialogTitle>
        <DialogContent>
          <DialogContentText id="alert-dialog-description">
            You're trying to remove a user. Do you wanna proceed?
          </DialogContentText>
        </DialogContent>
        <DialogActions>
          <Button onClick={this.handleClickCloseModal} color="primary">
            No
          </Button>
          <Button onClick={this.handleDeleteUser} color="primary" autoFocus>
            Yes, remove this user
          </Button>
        </DialogActions>
      </Dialog>
    )
  }

  render () {
    return (
      <div>
        <Breadcrumbs aria-label="Breadcrumb" component='div'>
          <Link color="inherit" component={RouterLink} to='/'>
            #ikpanel
          </Link>
          <Typography color="textPrimary">Users</Typography>
        </Breadcrumbs>
        <Button variant="contained" style={{ marginTop: 20, marginBottom: 20, marginRight: 20 }}>New user</Button>
        <Paper>
          <MaterialTable style={{ padding: 30 }} title={'Users'} isLoading={this.state.isLoading} columns={
            [
              { title: 'Name', field: 'name' },
              { title: 'Surname', field: 'surname' },
              { title: 'E-Mail', field: 'email' }
            ]} data={this.props.users.list} actions={[
            {
              icon: 'edit',
              tooltip: 'Edit user',
              onClick: (event, rowData) => console.log(rowData)
            },
            {
              icon: 'delete',
              tooltip: 'Remove user',
              onClick: (event, rowData) => this.handleClickOpenModal(rowData)
            }
          ]}/>
        </Paper>
        {this.showRemoveConfirm()}
      </div>

    )
  }

}

const mapStateToProps = (state) => {
  return {
    users: state.users
  }
}

const mapDispatchToProps = (dispatch) => {
  return {
    getUsers: () => {
      dispatch(getUsers())
    },
    removeUser: id => {
      dispatch(removeUser(id))
    }
  }
}

export default connect(mapStateToProps, mapDispatchToProps)(Users)