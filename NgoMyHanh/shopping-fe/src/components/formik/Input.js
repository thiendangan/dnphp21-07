import React from 'react';
import {Field,ErrorMessage} from 'formik';
import TextError from './TextError';

function Input(props) {
    const { label, name,type,...rest} = props;
    return (
        <div className="mb-3">
            <label className="form-label" htmlFor={name}>{label}</label>   
            <Field className="form-control" type={type} id={name} name={name} {...rest} />
            <ErrorMessage name={name} component={TextError}/>
        </div>
    )
}

export default Input
