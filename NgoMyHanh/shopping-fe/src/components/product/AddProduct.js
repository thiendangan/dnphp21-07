import React, {useEffect,useState} from "react";
import { useDispatch,useSelector } from "react-redux";
import axios from "axios";
import {addProduct} from '../../redux/actions/productActions';
import {selectedType,setTypes} from '../../redux/actions/typeActions';
import {setSubTypes} from '../../redux/actions/subTypeActions';
import { ServiceTypes } from "../../redux/contants/service-types";
import { addImage} from '../../redux/actions/imageAction';
import UpdateImage from "../UpdateImage";

const AddProduct = () => {
    const url_api   = ServiceTypes.URL_API;
    const types     = useSelector((state) => state.allTypes.types);
    const subTypes  = useSelector((state) => state.allSubTypes.subTypes);
    const imageId  = useSelector((state) => state.addImage.id);

    const [imageIdToWait, setImageIdToWait] = useState();

    const [file, setFile] = useState();

    const dispatch  = useDispatch();
    const [typeId, setTypeId] = useState('null');
    const [newProduct, setNewProduct] = useState({
		name: '',
		price: '',
		type_id: '',
		sub_type_id: '',
        note:'',
        image_id:'',
	})
    const { name, price,note} = newProduct;
    const onChangeNewProductForm = event =>{
        setNewProduct({ ...newProduct, [event.target.name]: event.target.value })
    }

    const checkType = (event) => {
        setTypeId(event.target.value);
        setNewProduct({ ...newProduct, [event.target.name]: event.target.value })
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

    return(
        <div>
              <form>
                <div className="mb-3">
                    <label className="label">Tên sản phẩm</label>
                    <input 
                        required
                        type="text" 
                        name="name"
                        value={name}
                        className="form-control"  
                        aria-describedby="emailHelp" 
                        onChange={onChangeNewProductForm}
                        />
                </div>
                <div className="mb-3">
                    <label className="form-label">Loại sản phẩm</label>
                    <select id="select" 
                            value={typeId} 
                            name="type_id"
                            className="form-select" 
                            onChange={checkType}
                            >
                        <option value='null' >Loại sản phẩm</option>
                         {renderListType} 
                    </select>
                </div>
                <div className="mb-3">
                    <label className="form-label">Danh mục sản phẩm</label>
                    <select 
                        id="select"
                        className="form-select"
                        name="sub_type_id"
                        onChange={onChangeNewProductForm}
                        >
                        <option value="null">Danh mục sản phẩm</option>
                        {renderListSubType}
                    </select>
                </div>
                <div className="mb-3">
                    <label  className="form-label">Giá</label>
                    <input type="number" 
                           min={0} 
                           value={price}
                           onChange={onChangeNewProductForm}
                           name="price"
                           className="form-control" 
                           aria-describedby="emailHelp" />
                </div>
                <div className="mb-3">
                    <label className="form-label">Mô tả</label>
                    <input type="text" 
                            value={note}
                           className="form-control" 
                           aria-describedby="emailHelp"
                           name="note"
                           onChange={onChangeNewProductForm}
                         />
                </div>
                
            </form>
            <div>
            <div className="mb-3">
                    <UpdateImage setFile={setFile}/>
                </div>
                <div className="mb-3">
                <input 
                    type="hidden"
                    name="image_id"
                    value={imageId}
                    onChange={onChangeNewProductForm}
                         />
                </div>
                <button className="btn btn-primary" onClick={()=>{uploadImage();
                                                                 
                                                                }}>
                        Create</button>
            </div>
            </div>
    )
}

export default AddProduct;