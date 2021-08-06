import React, {useEffect,useState} from "react";
import { useDispatch,useSelector } from "react-redux";
import axios from "axios";
import {selectedProduct} from '../../redux/actions/productActions';
import {selectedType,setTypes} from '../../redux/actions/typeActions';
import {setSubTypes} from '../../redux/actions/subTypeActions';
import { ServiceTypes } from "../../redux/contants/service-types";
import { Formik, Form } from 'formik';
 import * as Yup from 'yup';
import FormikControl from "../formik/FormikControl";
import { useParams } from "react-router-dom";


const UpdateProduct = () => {
    const url_api   = ServiceTypes.URL_API;
    const { id } = useParams();

    const types     = useSelector((state) => state.allTypes.types);
    const subTypes  = useSelector((state) => state.allSubTypes.subTypes);
    const product = useSelector(state => state.product);
    const images_position = useSelector(state => state.product.sub_images_position);

    const [position,setPosition] = useState({
        1:"https://static.thenounproject.com/png/187803-200.png",
        2:"https://static.thenounproject.com/png/187803-200.png",
        3:"https://static.thenounproject.com/png/187803-200.png",
        4:"https://static.thenounproject.com/png/187803-200.png"
    })

    
    const test = () => {
        if (images_position){
            Object.keys(images_position).forEach(key => {
                 setPosition({...position,1:images_position[key].path});
                 console.log(position);
              });
    }
    }
    
   
    const dispatch  = useDispatch();
    const [typeId, setTypeId] = useState('');
    const [checkDeleteImage, setCheckDeleteImage] = useState({
        1: false,
        2: false,
        3: false,
        4: false
    });

   
    const {name,code,sub_type_id,type_id,price,note,type_name,sub_type_name,image_path}=product;

    const [initialValues,setInitialValues] = useState({
		name: name,
		price: price,
		type_id: type_id,
		sub_type_id: sub_type_id,
        note:note,
        image_id:'',
	})

    
    

    const changeTypeId = (event) => {
        if (event.target.name==="type_id"){
        setTypeId(event.target.value);
        console.log("type id = ",event.target.value);
    }
    }
    

    
    const updateProduct = async(values) => {
        const formData = new FormData(); 
        if (values.file[0]){
        formData.append(
            "file[0]",
            values.file[0],
        );  
        }
        if (values.file[1]){
            formData.append(
                "file[1]",
                 values.file[1],
            ); 
        }
        else 
            if (product.sub_image_ids[1]&&checkDeleteImage){
                formData.append(
                    "file[1]",
                     "delete",
                ); 
            }
       

        if (values.file[2]){
        formData.append(
            "file[2]",
             values.file[2],
        ); 
    }
    if (values.file[3]){
        formData.append(
            "file[3]",
             values.file[3],
        ); 
    }
    if (values.file[4]){
        formData.append(
            "file[4]",
             values.file[4],
        );  
    }
        formData.append(
            "data",
            JSON.stringify({
                "id": id,
                "name": values.name,
                "price": values.price,
                "type_id": values.type_id,
                "sub_type_id": values.sub_type_id,
                "note": values.note
              })
        );  
        formData.append(
            "check",
            JSON.stringify({
                "1": checkDeleteImage[1],
                "2": checkDeleteImage[2],
                "3": checkDeleteImage[3],
                "4": checkDeleteImage[4]
              })
        );  
       
        console.log("file = ",formData);
        console.log("check delete ",checkDeleteImage);
        
        const response = await axios
        .post(`${url_api}/product/update`,
            formData
        )
        .catch((err) => {
            console.log("err ",err);
        })
        console.log("imageCReate =  ",response);
      };

   
    
  
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
    
    const fetchProductDetail = async(idProduct) => {
        const response = await axios
        .post(`http://localhost:8000/api/product/detail`,{
            "id": idProduct,
        })
        .catch((err) => {
            console.log("err ",err);
        })
        dispatch(selectedProduct(response?.data));
    }
    
      useEffect(()=>{
        test();
         fetchProductDetail(id);
         
      },[id]);

    useEffect(() => {
        fetchTypeDetail(typeId);
        fetchSubTypes(typeId);
    },[typeId]);

    useEffect(() => {
        fetchTypes();
        fetchProductDetail(id);
    },[]);

    const DisplayingErrorMessagesSchema = Yup.object().shape({
        name: Yup.string()
          .min(2, 'Too Short!')
          .max(50, 'Too Long!')
          .required('Required'),
        type_id: Yup.number().required("Required"),
        sub_type_id: Yup.number().required("Required"),
        price: Yup.number().required("Required")
            .min(0,'must >=0'),
        // file: Yup.object().shape({
        //     1: Yup.mixed().required("Required")
        // }),
      }); 

      const formUpdate = () => {

      }
    return(
   
    <div>
     
     <Formik
       initialValues={initialValues}
       validationSchema={DisplayingErrorMessagesSchema}
       onSubmit={(values, {resetForm}) => {
            updateProduct(values);
            console.log("values ",values.file);
            console.log("check",checkDeleteImage.file1);
        }}
       
     >
       {({values,setFieldValue}) => (
          
         <Form onChange={changeTypeId}>
             <div className="row p-5">
            <div className="col-sm-6">
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
                name_default={type_name}
                id={type_id}  
            />
            <FormikControl 
                control='select'  
                label='Danh mục sản phẩm' 
                name='sub_type_id'
                options={subTypes}
                name_default={sub_type_name}
                id={sub_type_id}
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
                control='imageUpdate' 
                label='' 
                name='file[0]'
                setFieldValue={setFieldValue}
                path={image_path}
            />
           <button type="submit">cập nhật sản phẩm</button>
           </div>
           <div className="col-sm-6">
               <div className="row">
                   <div className="col-sm-6">
                   <FormikControl 
                        control='imageUpdate' 
                        label='' 
                        name='file[1]'
                        setFieldValue={setFieldValue}
                        setCheckDeleteImage={setCheckDeleteImage}
                        checkDeleteImage={checkDeleteImage}
                        path={position[1]}
                    />
                    <FormikControl 
                        control='imageUpdate' 
                        label='' 
                        name='file[2]'
                        setFieldValue={setFieldValue}
                        setCheckDeleteImage={setCheckDeleteImage}
                        checkDeleteImage={checkDeleteImage}
                    />
                   </div>
                   <div className="col-sm-6">
                   <FormikControl 
                        control='imageUpdate' 
                        label='' 
                        name='file[3]'
                        setFieldValue={setFieldValue}
                        setCheckDeleteImage={setCheckDeleteImage}
                        checkDeleteImage={checkDeleteImage}
                    />
                    <FormikControl 
                        control='imageUpdate' 
                        label='' 
                        name='file[4]'
                        setFieldValue={setFieldValue}
                        setCheckDeleteImage={setCheckDeleteImage}
                        checkDeleteImage={checkDeleteImage}

                    />
                   </div>
                </div>
           </div>
           </div>
         </Form>
       
       )}
     </Formik>
  
              
</div>
    )
}

export default UpdateProduct;