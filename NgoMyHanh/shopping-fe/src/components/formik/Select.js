import React from 'react';
import {Field,ErrorMessage} from 'formik';
import TextError from './TextError';

function Select(props) {
    const { id,name_default,label, name, options,...rest} = props;
    return (
        <div className="mb-3">
            <label className="form-label" htmlFor={name}>{label}</label>   
            <Field  as="select" 
                    className="form-control" 
                    id={name}
                    name={name} 
                    {...rest}  
                    >
            <option value={id}  selected disabled hidden>{name_default}</option>
            <option key="select an option" value="">
                            Chọn
            </option>
                {options.map(option=>{
                    return(
                        <option key={option.id} value={option.id}>
                            {option.name}
                        </option>
                    )
                })}
            </Field>
            <ErrorMessage name={name} component={TextError}/>
        </div>
    )
}

export default Select
