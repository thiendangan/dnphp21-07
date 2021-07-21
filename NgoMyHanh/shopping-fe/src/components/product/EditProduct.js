import React, {useEffect,useState} from "react";
import { useDispatch,useSelector } from "react-redux";
import axios from "axios";
import {selectedType,setTypes} from '../../redux/actions/typeActions';
import {setSubTypes} from '../../redux/actions/subTypeActions';
import { ServiceTypes } from "../../redux/contants/service-types";
import UpdateImage from "../UpdateImage";
import { useParams } from "react-router-dom";
import { selectedProduct } from "../../redux/actions/productActions";



const EditProduct = () => {
  
    const url_api   = ServiceTypes.URL_API;
    const types     = useSelector((state) => state.allTypes.types);
    const subTypes  = useSelector((state) => state.allSubTypes.subTypes);
    const imageId  = useSelector((state) => state.addImage.id);

    const product = useSelector(state => state.product);
    const { id } = useParams();
    const dispatch = useDispatch();
    const {name,code,sub_type_name,type_name,price,note,image_path}=product;

    const [typeId, setTypeId] = useState('null');
    const [newProduct, setNewProduct] = useState({
		name: '',
		price: '',
		type_id: '',
		sub_type_id: '',
    note:'',
    image_id:'',
	})

  const fetchProductDetail = async() => {
    const response = await axios
    .post(`http://localhost:8000/api/product/detail`,{
        "id": id,
    })
    .catch((err) => {
        console.log("err ",err);
    })
    dispatch(selectedProduct(response?.data));
}

  useEffect(()=>{
      if (id && id !=="") fetchProductDetail();
  },
  [id]);

    const onChangeNewProductForm = event =>{
        setNewProduct({ ...newProduct, [event.target.name]: event.target.value })
    }

    const checkType = (event) => {
        setTypeId(event.target.value);
        setNewProduct({ ...newProduct, [event.target.name]: event.target.value })
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
        {Object.keys(product).length===0 ? (
                <div>....Loading</div>
            ):(
        <div className="row">
        <div className="col-md-6">
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
                        <option value={id} selected disabled hidden>{type_name}</option>
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
                        <option selected disabled hidden>{sub_type_name}</option>
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
                    <UpdateImage />
                </div>
                <div className="mb-3">
                <input 
                    type="hidden"
                    name="image_id"
                    value={imageId}
                    onChange={onChangeNewProductForm}
                         />
                </div>
                <button className="btn btn-primary" onClick={()=>{
                                                                 
                                                                }}>
                        Create</button>
            </div>
            </div>
            <div className="col-md-6"></div>
            </div>
            )}
      </div>                                                          
    )

}

export default EditProduct;