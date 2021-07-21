import React from "react";
import { useSelector } from "react-redux";
import { Link } from "react-router-dom";

const ProductComponent = () => {
    const products = useSelector((state)=>state.allProducts.products.data);
    const renderList = products?.map((product) => {
        const {id,name,price,image_path}=product;
        return (
            <div className="col-6 col-md-3" key={id}>
            <Link to={`/product/${id}`}>
                <div className="card text-center shadow p-2 mb-2 bg-body rounded">
                    <img src={image_path}
                        className="card-img-top w-1" alt="..." />
                    <div className="card-body">
                        <h5 className="card-title">{name}</h5>
                        <h5 className="card-title">price: {price} VND</h5> 
                    </div>
                </div>
            </Link>
            </div>
          );
    });
    return <>{renderList}</>;
};
  export default ProductComponent;
  