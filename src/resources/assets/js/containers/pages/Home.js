import React, { Component } from 'react'
import Breadcrumbs from '@material-ui/core/Breadcrumbs'
import Typography from '@material-ui/core/Typography'

class Home extends Component {
  render () {
    return (
      <div>
        <Breadcrumbs aria-label="Breadcrumb" component='div'>
          <Typography color="textPrimary">#ikpanel</Typography>
        </Breadcrumbs>
      </div>
    )
  }
}

export default Home