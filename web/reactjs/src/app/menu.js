import React from 'react'
import {render} from "react-dom";
import Left from './modules/LeftMenu';
import {BrowserRouter as Router, Route, Switch} from 'react-router-dom';
const PATHNAME = window.location.pathname.substring(0,3);
const app = (
    <Router>
        <Switch>
            <Route exact compact component={Left}/>
        </Switch>
    </Router>
);

render(app, window.document.getElementById('sidebar-menu'));