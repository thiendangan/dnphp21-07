import React,{useEffect,useState} from "react";
import axios from "axios";
import { useDispatch,useSelector } from "react-redux";
import { useParams } from "react-router-dom";
import { selectedProduct } from "../redux/actions/productActions";
import "./product.css";
import  'mdb-ui-kit';


const ProductDetail = () => {
    const product = useSelector(state => state.product);
    const sub_images = useSelector(state => state.product.sub_images);
    const { id } = useParams();
    const dispatch = useDispatch();
    const {name,code,sub_type_name,type_name,price,note,image_path}=product;
    console.log("sub_image = ",sub_images);
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

    const renderItemListImage = sub_images?.map((sub_image) => {
      const {id,path}=sub_image;
      return (
        <div className="carousel-item">
          <img value={id} src={path} className="d-block w-100" alt="" />
        </div>
      )
  });

  var slide = 0;
  const renderButtonListImage = sub_images?.map((sub_image) => {
    slide = slide +1;
    const {id,path}=sub_image;
    return (
      <button type="button" 
              data-mdb-target="#carouselExampleIndicators" 
              data-mdb-slide-to={slide} 
              aria-label={slide}
              style={{width: '100px'}}>
              <img value={id} className="d-block w-100" src={path} />
      </button>
    )
});

    return (
        <div>
            {Object.keys(product).length===0 ? (
                <div>....Loading</div>
            ):(
        	
	<div class="container">
    <div class="card">
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-6">
                <div id="carouselExampleIndicators" className="carousel slide carousel-fade" data-mdb-ride="carousel">
                <div className="carousel-inner mb-5">
                  <div className="carousel-item active">
                    <img src={image_path} className="d-block w-100" alt="..." />
                  </div>
                  {renderItemListImage}
                  
                </div>
               
                <button className="carousel-control-prev" type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide="prev">
                  <span className="carousel-control-prev-icon" aria-hidden="true" />
                  <span className="visually-hidden">Previous</span>
                </button>
                <button className="carousel-control-next" type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide="next">
                  <span className="carousel-control-next-icon" aria-hidden="true" />
                  <span className="visually-hidden">Next</span>
                </button>
                <div className="carousel-indicators" style={{marginBottom: '-20px'}}>
                  <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to={0} className="active" aria-current="true" aria-label="Slide 1" style={{width: '100px'}}>
                    <img className="d-block w-100" src={image_path} />
                  </button>
                  {renderButtonListImage}
                </div>
              </div>
                    
                </div>
                <div class="details col-md-6">
                    <h3 class="product-title">{name}</h3>

                    <p class="product-description">{note}</p>
                    <h4 class="price">Giá hiện tại: <span>${price}</span></h4>
                    <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
                    <h5 class="sizes">Mã sản phẩm:
                        <span class="size" data-toggle="tooltip" title="small">{code}</span>
                    </h5>
                    <h5 class="sizes">Loại sản phẩm:
                        <span class="size" data-toggle="tooltip" title="small">{type_name}</span>
                    </h5>
                    <h5 class="sizes">Danh mục sản phẩm:
                        <span class="size" data-toggle="tooltip" title="small">{sub_type_name}</span>
                    </h5>
                    <div class="action">
                        <button class="add-to-cart btn btn-default" type="button">add to cart</button>
                        <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            )}
        </div>
    )

}

export default ProductDetail;