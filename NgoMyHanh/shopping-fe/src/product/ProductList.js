import React, {useEffect,useState} from "react";
import { useDispatch,useSelector } from "react-redux";
import axios from "axios";
import {setProducts} from '../redux/actions/productActions';
import {selectedType,setTypes} from '../redux/actions/typeActions';
import ProductComponent from "./ProductComponents";
import { ServiceTypes } from "../redux/contants/service-types";
import Pagination from "react-js-pagination";
import {setSubTypes} from '../redux/actions/subTypeActions';




const ProductList = () => {
    const url_api   = ServiceTypes.URL_API;
    const dispatch = useDispatch();
    const types     = useSelector((state) => state.allTypes.types);
    const subTypes  = useSelector((state) => state.allSubTypes.subTypes);
    const [request, setRequest] = useState({
		type_id: "null",
		sub_type_id: "null",
        key_word:""
	})

    const onChangeRequest = (event) => {
        
        console.log("event ",event.target.name);
        if (event.target.name==="type_id" ){
            setRequest({ ...request, ["sub_type_id"]: "null",[event.target.name]: event.target.value });
        }
        else setRequest({ ...request, [event.target.name]: event.target.value });
        

    }
   
    const [pageProduct,setPageProduct] = useState({});

    const fetchProducts = async(pageNumber) => {
        console.log("fetch type = ",request.type_id," subtype = ",request.sub_type_id);
        const url_api = ServiceTypes.URL_API;
        const response = await axios
        .post(`${url_api}/product/list?page=${pageNumber}`,
            request
        )
        .catch((err) => {
            console.log("err ",err);
        })

        setPageProduct(response.data);
        dispatch(setProducts(response.data));
    }

    const fetchTypes = async() => {
        const response = await axios
        .get(`${url_api}/type/list`)
        .catch((err) => {
            console.log("err ",err);
        })
        dispatch(setTypes(response.data));
    }

    const fetchSubTypes = async(typeId) => {
        const response = await axios
        .post(`${url_api}/sub-type/list`,{
            "type_id":typeId,
        })
        .catch((err) => {
            console.log("err ",err);
        })
        console.log("list sub type = ",response.data);
        dispatch(setSubTypes(response.data));
    }
    

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

    const paginate = () =>{
        const {current_page,per_page,total,last_page}=pageProduct;
        if (last_page>1)
        return(
            <Pagination
                activePage={current_page}
                itemsCountPerPage={per_page}
                totalItemsCount={total}
                pageRangeDisplayed={5}
                onChange={(pageNumber)=>fetchProducts(pageNumber)}
                itemClass="page-item"
                linkClass="page-link"
                firstPageText="First"
        />
        )
    }
    
    useEffect(() => {
        fetchTypes();
    },[]);

    useEffect(() => {    
        fetchProducts();
    },[request]);
   

    useEffect(() => {    
        fetchSubTypes(request.type_id);
    },[request.type_id]);

    return(
        <div className="container">
        <div className="row">
            <div className="col-12">
                <div className="row m-5">
                <div className="col-12 col-lg-4 p-1">
                    <select id="select" 
                            name="type_id"
                            onChange={onChangeRequest}
                            className="form-select" 
                            >
                        <option value='null'>Loại sản phẩm</option>
                        {renderListType}
                    </select>
                </div>
                <div className="col-12 col-lg-4 p-1">
                    <select id="select" 
                            name="sub_type_id"
                            onChange={onChangeRequest}
                            className="form-select" 
                            >
                        <option value='null'>Danh mục sản phẩm</option>
                        {renderListSubType}
                    </select>
                </div>
                <div className="col-12 col-lg-4 p-1">
                    <input type="search" 
                           placeholder="Search"
                           onChange={onChangeRequest}
                           name="key_word"
                           className="form-control" 
                           aria-describedby="emailHelp" />                
                    </div>
                </div>
                <div className="row">
                    <ProductComponent/>
                </div>
                {paginate()}
            </div>
        </div>
        </div>
    )
}

export default ProductList;