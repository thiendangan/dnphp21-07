import React,{useState} from 'react';
import {Field,ErrorMessage} from 'formik';
import TextError from './TextError';
import Thumb from '../Thumb';

function Image(props) {
    const { checkSubmit,setCheckSubmit,label, name,setFieldValue,...rest} = props;
    const [file, setFile] = useState();
    return (
        <div className="form-group">
                  <label >{label}</label>
                  <label for={name}>
                    <img src="https://static.thenounproject.com/png/187803-200.png"/>
                </label>
                  <input id={name} name={name} style={{display:'none'}} type="file" onChange={(event) => {
                    setFieldValue("file", event.currentTarget.files[0]);
                    setFile(event.currentTarget.files[0]);
                    setCheckSubmit(true);
                  }} className="form-control" />
                 {checkSubmit && <Thumb file={file} />}
                 <ErrorMessage name={name} component={TextError}/>
        </div>
    )
}

export default Image;
