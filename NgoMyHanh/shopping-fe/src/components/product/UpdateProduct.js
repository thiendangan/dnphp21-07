import React, {useEffect,useState} from "react";
import { useDispatch,useSelector } from "react-redux";
import axios from "axios";
import {addProduct, selectedProduct} from '../../redux/actions/productActions';
import {selectedType,setTypes} from '../../redux/actions/typeActions';
import {setSubTypes} from '../../redux/actions/subTypeActions';
import { ServiceTypes } from "../../redux/contants/service-types";
import { addImage} from '../../redux/actions/imageAction';
import UpdateImage from "../UpdateImage";
import { Formik, Form, Field } from 'formik';
 import * as Yup from 'yup';
import FormikControl from "../formik/FormikControl";

const UpdateProduct = () => {
    const url_api   = ServiceTypes.URL_API;
    const types     = useSelector((state) => state.allTypes.types);
    const subTypes  = useSelector((state) => state.allSubTypes.subTypes);
    const imageId  = useSelector((state) => state.addImage.id);

    const [imageIdToWait, setImageIdToWait] = useState();

    const [file, setFile] = useState();

    
   
      

    const dispatch  = useDispatch();
    const [typeId, setTypeId] = useState('');
    const [newProduct, setNewProduct] = useState({
		name: '',
		price: '',
		type_id: '',
		sub_type_id: '',
        note:'',
        image_id:'',
        email:''
	})
    const { name, price,note} = newProduct;
    const onChangeNewProductForm = event =>{
        setNewProduct({ ...newProduct, [event.target.name]: event.target.value })
    }

    const changeTypeId = (event) => {
        if (event.target.name==="type_id"){
        setTypeId(event.target.value);
        console.log("type id = ",event.target.value);
    }
    }

    
    const uploadImage = async() => {
        console.log("----------------------------------------------------------------");
        console.log("UPLOAD IMAGES");
        const formData = new FormData();      
        formData.append(
            "file",
             file,
        );   
        console.log("file = ",formData)
        const response = await axios
        .post(`${url_api}/image/upload`,
            formData
        )
        .catch((err) => {
            console.log("err ",err);
        })
        console.log("imageCReate =  ",response.data.data);
        if (response){
            dispatch(addImage(response.data.data));
            console.log("response.data.data",response.data.data)
            setNewProduct({...newProduct,['image_id']: response.data.data.id});
            setImageIdToWait(imageId);       
        }
        // setNewProduct({...newProduct,['image_id']: imageId});
      };

    const createProduct = async () => {
       
        console.log("CREATE PRODUCT");
        console.log("craete new product", newProduct );

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

    

  

    const renderListType = types.map((type) => {
        const {id,name}=type;
        return (
            <option value={id}>{name}</option>
        )
    });

    const renderListSubType = subTypes.map((subType) => {
        const {id,name}=subType;
        return (
            <option value={id}>{name}</option>
        )
    });

    const DisplayingErrorMessagesSchema = Yup.object().shape({
        name: Yup.string()
          .min(2, 'Too Short!')
          .max(50, 'Too Long!')
          .required('Required'),
        type_id: Yup.number().required("Required"),
        sub_type_id: Yup.number().required("Required"),
        price: Yup.number().required("Required")
            .min(0,'must >=0'),
      });
    return(
        <div>
        <div>
     
     <Formik
       initialValues={newProduct}
       validationSchema={DisplayingErrorMessagesSchema}
       onSubmit={values => {
         // same shape as initial values
         console.log(values);
       }}
       
     >
       {formik => (
         <Form onChange={changeTypeId}>
            
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
                control='input' 
                label='Mô tả' 
                name='image'
                type="file"
            />
           <button type="submit">Submit</button>
         </Form>
         
       )}
     </Formik>
   </div>
              
</div>
    )
}

export default UpdateProduct;