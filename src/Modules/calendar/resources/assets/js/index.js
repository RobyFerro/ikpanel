import React from 'react';
import ReactDom from 'react-dom';
import Calendar from './containers/Calendar';
import store from "./store";
import {Provider} from 'react-redux';

ReactDom.render(<Provider store={store}><Calendar/></Provider>, document.querySelector('#calendar'));
