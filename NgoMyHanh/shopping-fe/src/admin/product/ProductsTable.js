import React, {useEffect} from "react";
import { useDispatch,useSelector } from "react-redux";
import axios from "axios";
import {setProducts} from '../../redux/actions/productActions';
import { setTypes } from "../../redux/actions/typeAction";
import { ServiceTypes } from "../../redux/contants/service-types";
import Pagination from "react-js-pagination";


const ProductsTable = () => {
    const url_api = ServiceTypes.URL_API;
    const products = useSelector((state) => state.allProducts.products);
    const types = useSelector((state) => state.allTypes.types);
    const dispatch = useDispatch();

    const fetchProducts =async(e) => {
        // e.preventDefault();
        // const payload = new FormData(e.target);
        // console.log("payload", payload);
        const response = await axios
        .post(`${url_api}/product/list`,{
            "type_id":null,
            "sub_type_id":null
        })
        .catch((err) => {
            console.log("err ",err);
        })
        dispatch(setProducts(response.data));
    }
  
    const fetchTypes = async() => {
        const response = await axios
        .get(`${url_api}/type/list`)
        .catch((err) => {
            console.log("err ",err);
        })
        dispatch(setTypes(response.data));
        console.log("data ",response.data);
    }
    useEffect(() => {
        fetchProducts();
    },[]);

    useEffect(() => {
        fetchTypes();
    },[]);

    var stt=0;
    const renderListProduct = products.map((product) => {
        stt=stt+1;
        const {id,name,price,code,sub_type_name}=product;
        return (
            <tr>
                <th scope="row">{stt}</th>
                <td>{name}</td>
                <td>{code}</td>
                <td>{sub_type_name}</td>
                <td>{price}</td>
                <td>
                    <th><button type="button" className="btn btn-success">Cập nhật</button></th>
                    <th><button type="button" className="btn btn-danger">Xóa</button></th>
                </td>
            </tr>
          );
    });

    const renderListType = types.map((type) => {
        const {id,name}=type;
        return (
            <option>{name}</option>
        )
    });
    return(
        <div className="container">
        <div className="row">
            <div className="col-1">
                xin chao
            </div>
            <div className="col-7">
                <div className="row">
                <table className="table">
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
                </div>
            </div>
            <div className="col-1">

            </div>
            <div className="col-3">
              <form onSubmit={(e) => fetchProducts(e)}>
                <div className="mb-3">
                    <label htmlFor="exampleInputEmail1" className="form-label">Tên sản phẩm</label>
                    <input type="text" className="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
                </div>
                <div className="mb-3">
                    <label htmlFor="exampleInputPassword1" className="form-label">Loại sản phẩm</label>
                    <select id="select" className="form-select">
                        <option>Loại sản phẩm</option>
                        {renderListType}
                    </select>
                </div>
                <div className="mb-3">
                    <label htmlFor="exampleInputPass    word1" className="form-label">Danh mục sản phẩm</label>
                    <select id="select" className="form-select">
                        <option>Disabled select</option>
                        <option>Disabled select</option>
                    </select>
                </div>
                <div className="mb-3">
                    <label htmlFor="exampleInputEmail1" className="form-label">Giá</label>
                    <input type="number" min={0} className="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
                </div>
                <div className="mb-3">
                    <label htmlFor="exampleInputEmail1" className="form-label">Mô tả</label>
                    <input type="text" className="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
                </div>
                <button type="submit" className="btn btn-primary">Submit</button>
            </form>
            </div>
        </div>
        </div>
    )
}

export default ProductsTable;