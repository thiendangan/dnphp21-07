import React, {useEffect,useState} from "react";
import { useDispatch,useSelector } from "react-redux";
import { confirmAlert } from 'react-confirm-alert';
import 'react-confirm-alert/src/react-confirm-alert.css';
import axios from "axios";
import {setProducts,addProduct} from '../../redux/actions/productActions';
import { ServiceTypes } from "../../redux/contants/service-types";
import Pagination from "react-js-pagination";
import { Link } from "react-router-dom";

const DeleteProductConfirm = (...props) => 
    {
        console.log("id = ",props);
        const url_api   = ServiceTypes.URL_API;
        const dispatch  = useDispatch();
        const product   = useSelector((state) => state.addProduct);
        // const deleteProduct = async() => {
        //     const response = await axios
        //     .post(`${url_api}/product/delete`,{
        //         "id":id,
        //     })
        //     .catch((err) => {
        //         console.log("err ",err);
        //     })
        //     dispatch(addProduct(response));            
        // }
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
                //   deleteProduct();
                }}
              >
                Yes, Delete it!
              </button>
            </div>
          );
        }
      });

    }

    export default DeleteProductConfirm;