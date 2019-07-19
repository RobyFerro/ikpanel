import React from "react";
import ReactDOM from 'react-dom';
import {Provider} from 'react-redux';
import store from './store';
import Main from './containers/Main';

ReactDOM.render(<Provider store={store}><Main/></Provider>, document.getElementById('app'));