import React from 'react';
import { render } from 'react-dom';
import Test from '../components/Test.jsx';

console.log(document.getElementById('app'))

render(
    document.getElementById('app'),
    <Test text={"Toto"}/>,
);
