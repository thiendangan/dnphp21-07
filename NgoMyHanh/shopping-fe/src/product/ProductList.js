import React, {useEffect} from "react";
import { useDispatch,useSelector } from "react-redux";
import axios from "axios";
import {setProducts} from '../redux/actions/productActions';
import ProductComponent from "./ProductComponents";
import Pagination from "react-js-pagination";

const ProductList = () => {
    const products = useSelector((state) => state);
    const dispatch = useDispatch();

    const fetchProducts = async() => {
        const response = await axios
        .post("http://localhost:8000/api/product/list",{
            "type_id":null,
            "sub_type_id":null
        })
        .catch((err) => {
            console.log("err ",err);
        })
        dispatch(setProducts(response.data));
    }
  
    useEffect(() => {
        fetchProducts();
    },[]);
    return(
        <div className="container">
        <div className="row">
            <div className="col-2">
                xin chao
            </div>
            <div className="col-10">
                <div className="row">
                    <ProductComponent/>
                </div>
            </div>
        </div>
        </div>
    )
}

export default ProductList;