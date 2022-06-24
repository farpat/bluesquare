import React from 'react';
import PropTypes from 'prop-types';

function Test ({ text }) {
    return (
        <div>
            Here Test in Test.jsx {text}
        </div>
    );
}

Test.propTypes = {
    text: PropTypes.string.isRequired,
};

export default Test;
