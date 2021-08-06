import React, {useEffect,useState} from "react";
import { useDispatch,useSelector } from "react-redux";

import { confirmAlert } from 'react-confirm-alert';
import 'react-confirm-alert/src/react-confirm-alert.css';

import axios from "axios";
import {setProducts,addProduct} from '../../redux/actions/productActions';
import { ServiceTypes } from "../../redux/contants/service-types";

import Pagination from "react-js-pagination";
import { Link } from "react-router-dom";




const ListProduct = () => {
    const url_api   = ServiceTypes.URL_API;
    const products  = useSelector((state) => state.allProducts.products);
    const product   = useSelector((state) => state.addProduct);

    const dispatch  = useDispatch();
    const [pageProduct,setPageProduct] = useState({});
    const [number,setNumber] = useState(1);
    
    const fetchProducts =async(pageNumber) => {
        setNumber(pageNumber);
        const response = await axios
        .post(`${url_api}/product/list?page=${pageNumber}`,{
            "type_id":"null",
            "sub_type_id":"null",
            "key_word":""
        })
        .catch((err) => {
            console.log("err ",err);
        })
        setPageProduct(response.data);
        dispatch(setProducts(response.data.data));
    }
   
  
    useEffect(() => {
        fetchProducts();
    },[product]);

    const deleteProductConfirm = (id) => 
    {
        const deleteProduct = async() => {
            const response = await axios
            .post(`${url_api}/product/delete`,{
                "id":id,
            })
            .catch((err) => {
                console.log("err ",err);
            })
            dispatch(addProduct(response));            
        }
        console.log("id = ",id);
        confirmAlert({
        customUI: ({ onClose }) => {
          return (
            <div className='custom-ui'>
              <h1>Are you sure?</h1>
              <p>You want to delete this file?</p>
              <button onClick={onClose}>No</button>
              <button
                onClick={() => {
                  onClose();
                  deleteProduct();
                }}
              >
                Yes, Delete it!
              </button>
            </div>
          );
        }
      });

    }
    
    var stt;
    if (number) stt=(number-1)*10
    else stt=0;
    const renderListProduct = products.map((product) => {
        stt=stt+1;
        const {id,name,price,code,sub_type_name }=product;
        return (
            <tr>
                <th scope="row">{stt}</th>
                <td>{name}</td>
                <td>{code}</td>
                <td>{sub_type_name}</td>
                <td>{price}</td>
                <td>
                    <th>
                        <Link to={`/product/edit/${id}`}>
                        <button type="button" className="btn btn-success">Sửa</button>
                        </Link>
                    </th>
                    <th>
                        <button 
                            onClick={()=>{
                                deleteProductConfirm(id);
                            }}
                            type="button" 
                            className="btn btn-danger">
                            Xóa
                        </button></th>
                </td>
            </tr>
          );
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

    return(
        <div>
        <table className="table table-hover">
            <thead className="table-dark">
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Mã sản phẩm</th>
                <th scope="col">Danh mục sản phẩm</th>
                <th scope="col">Giá</th>
                <th scope="col">Thao tác</th>
            </tr>
            </thead>
            <tbody>
            {renderListProduct}
            </tbody>
        </table>
            {paginate()}
        </div>   
    )
}

export default ListProduct;