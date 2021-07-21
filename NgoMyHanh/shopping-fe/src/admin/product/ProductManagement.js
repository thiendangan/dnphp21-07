import React from "react";
import AddProduct from "../../components/product/AddProduct";
import ListProduct from "../../components/product/ListProduct";

const ProductManagement = () => {
    return(
        <div className="container">
        <div className="row">
            <div className="col-md-1">
                xin chao
            </div>
            <div className="col-md-7">
                <div className="row">
                    <ListProduct/>
                </div>
            </div>
            <div className="col-md-1">

            </div>
            <div className="col-md-3">
                <AddProduct/>
            </div>
        </div>
        </div>
    )
}

export default ProductManagement;