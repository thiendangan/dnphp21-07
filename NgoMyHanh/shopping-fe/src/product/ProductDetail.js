import React,{useEffect} from "react";
import axios from "axios";
import { useDispatch,useSelector } from "react-redux";
import { useParams } from "react-router-dom";
import { selectedProduct } from "../redux/actions/productActions";

const ProductDetail = () => {
    const product = useSelector(state => state.product);
    const { id } = useParams();
    const dispatch = useDispatch();
    const fetchProductDetail = async() => {
        const response = await axios
        .post(`http://localhost:8000/api/product/detail`,{
            "id": id,
        })
        .catch((err) => {
            console.log("err ",err);
        })
        console.log(response);
        dispatch(selectedProduct(response?.data));
    }

    useEffect(()=>{
        if (id && id !=="") fetchProductDetail();
    },
    [id]);

    return (
        <div>
            {Object.keys(product).length===0 ? (
                <div>....Loading</div>
            ):(
            <h1>
                detail
            </h1>
            )}
        </div>
    )

}

export default ProductDetail;