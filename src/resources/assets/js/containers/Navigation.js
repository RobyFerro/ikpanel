import React, { Component } from 'react'
import ListItem from '@material-ui/core/ListItem'
import ListItemText from '@material-ui/core/ListItemText'
import List from '@material-ui/core/List'
import { ListItemIcon } from '@material-ui/core'
import { getMainMenuItems, handleCondensedItems } from '../actions/navActions'
import { connect } from 'react-redux'
import Icon from '@material-ui/core/Icon'
import ExpandMore from '@material-ui/icons/ExpandMore'
import ExpandLess from '@material-ui/icons/ExpandLess'
import Collapse from '@material-ui/core/Collapse'
import { Link } from 'react-router-dom'

class Navigation extends Component {

  constructor (props) {
    super(props)
    this.props.getMainMenuItems()
  }

  render () {
    return (
      <List component='nav' aria-labelledby="nested-list-subheader">
        <div>
          <ListItem button component={Link} to='/'>
            <ListItemIcon>
              <Icon className='fas fa-home'/>
            </ListItemIcon>
            <ListItemText primary="Home"/>
          </ListItem>
          {this.props.navigation.navItem.map((item, index) => {
            if (item.children.length === 0) {
              return (
                <ListItem button key={index} component="button">
                  <ListItemIcon>
                    <Icon className={item.icon}/>
                  </ListItemIcon>
                  <ListItemText primary={item.name}/>
                </ListItem>
              )
            } else {
              return (
                <div key={index}>
                  <ListItem button key={index} component="button"
                            onClick={() => this.props.handleCondensedItems(index)}>
                    <ListItemIcon>
                      <Icon className={item.icon}/>
                    </ListItemIcon>
                    <ListItemText primary={item.name}/>
                    {item.open === null ? false : item.open ? <ExpandLess/> : <ExpandMore/>}
                  </ListItem>
                  <Collapse in={item.open === null ? false : item.open} timeout="auto" unmountOnExit>
                    {item.children.map((el, i) => {
                      return (
                        <List component="div" disablePadding key={i}>
                          <ListItem button style={{ backgroundColor: '#efefef' }} component={Link}
                                    to="/admin/react/users">
                            <ListItemIcon>
                              <Icon className={el.icon}/>
                            </ListItemIcon>
                            <ListItemText primary={el.name}/>
                          </ListItem>
                        </List>
                      )
                    })}

                  </Collapse>
                </div>
              )
            }

          })}
        </div>
      </List>
    )
  }
}

const mapStateToProps = (state) => {
  return {
    navigation: state.navigation
  }
}

const mapDispatchToProps = (dispatch) => {
  return {
    getMainMenuItems: () => {
      dispatch(getMainMenuItems())
    },
    handleCondensedItems: index => {
      dispatch(handleCondensedItems(index))
    }
  }
}

export default connect(mapStateToProps, mapDispatchToProps)(Navigation)