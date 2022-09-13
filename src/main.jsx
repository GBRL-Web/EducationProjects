import './app/assets/styles/index.css';
import 'react-toastify/dist/ReactToastify.css';
import '/node_modules/@fortawesome/fontawesome-svg-core/styles.css';
import './app/assets/styles/fonts/norwester.otf';

import React from 'react';
import ReactDOM from 'react-dom';

import App from './app/App';

ReactDOM.render(
    <React.StrictMode>
        <App />
    </React.StrictMode>,
    document.getElementById('root'),
);
