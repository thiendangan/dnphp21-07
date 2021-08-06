import React from 'react'
import Input from './Input';
import Select from './Select';
import TextArea from './TextArea';
import Image from './Image';
import ImageUpdate from './ImageUpdate';


function FormikControl(props) {
    const {control, ...rest} = props;
    switch (control) {
        case 'input':
            return <Input {...rest}/>;
        case 'select':
            return <Select {...rest}/>;
        case 'textarea':
            return <TextArea {...rest}/>;
        case 'image':
            return <Image {...rest}/>;
        case 'imageUpdate':
            return <ImageUpdate {...rest}/>;
        default: return null;
    }
   
}

export default FormikControl
