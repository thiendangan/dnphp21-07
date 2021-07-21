import React from 'react';
import {Field,ErrorMessage} from 'formik';
import TextError from './TextError';

function TextArea(props) {
    const { label, name,type,...rest} = props;
    return (
        <div className="mb-3">
            <label className="form-label" htmlFor={name}>{label}</label>   
            <Field as="textarea" className="form-control" id={name} name={name} {...rest} />
            <ErrorMessage name={name} component={TextError}/>
        </div>
    )
}

export default TextArea;
