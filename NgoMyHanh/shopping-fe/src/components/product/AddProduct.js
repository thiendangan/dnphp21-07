import React, {useEffect,useState} from "react";
import { useDispatch,useSelector } from "react-redux";
import axios from "axios";
import {addProduct} from '../../redux/actions/productActions';
import {selectedType,setTypes} from '../../redux/actions/typeActions';
import {setSubTypes} from '../../redux/actions/subTypeActions';
import { ServiceTypes } from "../../redux/contants/service-types";
import { addImage} from '../../redux/actions/imageAction';
import { Formik, Form } from 'formik';
 import * as Yup from 'yup';
import FormikControl from "../formik/FormikControl";

const AddProduct = () => {
    const url_api   = ServiceTypes.URL_API;
    const types     = useSelector((state) => state.allTypes.types);
    const subTypes  = useSelector((state) => state.allSubTypes.subTypes);
    const imageId  = useSelector((state) => state.addImage.id);

    const [imageIdToWait, setImageIdToWait] = useState();
    const [checkSubmit, setCheckSubmit] = useState(true);


    const dispatch  = useDispatch();
    const [typeId, setTypeId] = useState('');
    const [newProduct, setNewProduct] = useState({
		name: '',
		price: '',
		type_id: '',
		sub_type_id: '',
        note:'',
        image_id:218,
	})
    const [initialValues,setInitialValues] = useState({
		name: '',
		price: '',
		type_id: '',
		sub_type_id: '',
        note:'',
        image_id:'',
	})

    const changeTypeId = (event) => {
        if (event.target.name==="type_id"){
        setTypeId(event.target.value);
    }
    }
    const uploadImage = async(file,values) => {
        const formData = new FormData();      
        formData.append(
            "file",
             file,
        );   
        const response = await axios
        .post(`${url_api}/image/upload`,
            formData
        )
        .catch((err) => {
            console.log("err ",err);
        })
        if (response){
            dispatch(addImage(response.data));
           ;
         setValueNewroduct(values,response.data.id);
         setImageIdToWait(imageId);       
        }
      };
      const setValueNewroduct = (values, id) => {
        setNewProduct({...newProduct,
                        name:values.name,
                        type_id:values.type_id,
                        sub_type_id:values.sub_type_id,
                        price:values.price,
                        note:values.note,
                        image_id: id});
      }

    const createProduct = async () => {
      
        const response = await axios
        .post(`${url_api}/product/create`,
          newProduct
        )
        .catch((err) => {
            console.log("err ",err);
        })
        if (response){
            dispatch(addProduct(response.data.data));
        }
     
    }
    
  
    const fetchTypes = async() => {
        const response = await axios
        .get(`${url_api}/type/list`)
        .catch((err) => {
            console.log("err ",err);
        })
        dispatch(setTypes(response.data));
    }

    const fetchTypeDetail = async(typeId) => {
        const response = await axios
        .post(`${url_api}/type/detail`,{
            "id": typeId,
        })
        .catch((err) => {
            console.log("err ",err);
        })
        dispatch(selectedType(response?.data));
    }
    const fetchSubTypes = async(typeId) => {
        const response = await axios
        .post(`${url_api}/sub-type/list`,{
            "type_id":typeId,
        })
        .catch((err) => {
            console.log("err ",err);
        })
        dispatch(setSubTypes(response.data));
    }
    

    useEffect(() => {
        fetchTypeDetail(typeId);
        fetchSubTypes(typeId);
    },[typeId]);

    useEffect(()=>{
        createProduct()
    },[imageIdToWait])
    useEffect(() => {
        fetchTypes();
    },[]);

    

    const ErrorForm = Yup.object().shape({
        name: Yup.string()
          .min(2, 'Too Short!')
          .max(50, 'Too Long!')
          .required('Required'),
        type_id: Yup.number().required("Required"),
        sub_type_id: Yup.number().required("Required"),
        price: Yup.number().required("Required")
            .min(0,'must >=0'),
        file: Yup.mixed().required('A file is required'),
      });
    return(
        <div>
        <div>
     
     <Formik
       initialValues={initialValues}
       validationSchema={ErrorForm}
       onSubmit={(values, {resetForm}) => {
            uploadImage(values.file,values);
            resetForm(initialValues);
            setCheckSubmit(false);
          }}
       >
       {({setFieldValue}) => (
         <Form onChange={changeTypeId}
         >
           <FormikControl 
                control='input' 
                label='Name' 
                name='name'
                type="text"
            />
            <FormikControl 
                control='select'  
                label='Loại sản phẩm' 
                name='type_id'
                options={types}
            />
            <FormikControl 
                control='select'  
                label='Danh mục sản phẩm' 
                name='sub_type_id'
                options={subTypes}
            />
            <FormikControl 
                control='input' 
                label='Giá' 
                name='price'
                type="number"
            />
            <FormikControl 
                control='textarea' 
                label='Mô tả' 
                name='note'
            />
            <FormikControl 
                control='image' 
                label='' 
                name='file'
                setFieldValue={setFieldValue}
                checkSubmit={checkSubmit}
                setCheckSubmit={setCheckSubmit}
            />
           <button type="submit">Thêm sản phẩm</button>
         </Form>
         
       )}
     </Formik>
   </div>
              
</div>
    )
}

export default AddProduct;