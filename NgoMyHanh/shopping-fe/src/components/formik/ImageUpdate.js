import React,{useState} from 'react';
import {Field,ErrorMessage} from 'formik';
import TextError from './TextError';
import Thumb from '../Thumb';

function ImageUpdate(props) {
    const { label, name,setFieldValue,setCheckDeleteImage,checkDeleteImage,path,...rest} = props;
    const [file, setFile] = useState();
    const [checkChoose, setCheckChoose] = useState(false);
    const [src,setSrc] = useState(path);
    console.log(name," ",path);
    return (
        <div className="form-group">
                  <label >{label}</label>
                  <label for={name}>
                  {checkChoose ? <Thumb file={file} />:
                    <div className="text-center">
                        <img src={src} class="rounded" width="200" height="200"></img>
                    </div>
                }
                </label>
                  <input id={name} name={name} style={{display:'none'}} type="file" onChange={(event) => {
                    setFieldValue(`${name}`, event.currentTarget.files[0]);
                    setFile(event.currentTarget.files[0]);
                    setSrc("https://static.thenounproject.com/png/187803-200.png");
                    switch (name) {
                        case "file[1]":
                            setCheckDeleteImage({...checkDeleteImage,1:true});
                            break;
                        case "file[2]":
                            setCheckDeleteImage({...checkDeleteImage,2:true});
                            break;
                        case "file[3]":
                            setCheckDeleteImage({...checkDeleteImage,3:true});
                            break;
                        case "file[4]":
                            setCheckDeleteImage({...checkDeleteImage,4:true});
                            break;
                    
                        default:
                            break;
                    }
                   
                    if (event.currentTarget.files[0]){
                        setCheckChoose(true);
                    }
                    else {
                        setCheckChoose(false);
                    }
                    
                  }} className="form-control" />
                 <ErrorMessage name={name} component={TextError}/>
        </div>
    )
}

export default ImageUpdate;
