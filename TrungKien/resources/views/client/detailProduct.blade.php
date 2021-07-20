@extends('client.frame')
@section('detailProduct')
<!--/.row-->
<div class="header row">
            <div class="col-lg-3 col-md-4 col-sm-12">
                <a href="/">NCC Company</a>
            </div>
        </div>
<div class="row" id="listProduct" style="min-height:75vh;margin-bottom:1rem;">
    <div class="col-xs-12 col-md-12 col-lg-5" >
        <div style="margin-top :2rem;">
            <h3 style="display: block;font-weight: bold;margin-top :2rem;margin-bottom:2rem"> {{ $productInfor->product_name}} </h3>
            <label style="display: block; font-weight:500" class="form-label"> Mã sản phẩm: <span style="font-weight: normal; margin:0.5rem 0">{{ $productInfor->product_id }}</span></label>
            <label style="display: block;  font-weight:500"> Loại sản phẩm: <span style="font-weight: normal; margin:0.5rem 0">{{ $productInfor->product_type_name }}</span></label>
            <label style="display: block;  font-weight:500"> Danh mục sản phẩm: <span style="font-weight: normal; margin:0.5rem 0">{{ $productInfor->product_category_name }}</span></label>
            <label style="display: block;  font-weight:500"> Giá : <span style="font-weight: normal; margin:0.5rem 0">{{ number_format($productInfor->product_price) }} Đ</span"></span></label>
            <label style="display: block; font-weight:500">Mô tả:</label>
            <p style="text-align: left;font-size:1rem; min-height:85px; max-height:200px;overflow:auto">{{ $productInfor->product_description}}</p>
        </div>
    </div>
    <div class="col-xs-12 col-md-12 col-lg-7">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <?php for ($i = 2; $i < count($productInfor->product_image); $i++) { ?>
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>"></li>
                <?php } ?>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?= asset('ProductImage/' . $productInfor->product_image[0]) ?>" alt="image" style="object-fit:cover;border-radius:10px" class="d-block w-100">
                </div>
                <?php for ($i = 1; $i < count($productInfor->product_image); $i++) {
                    if (!empty($productInfor->product_image[$i])) { ?>
                        <div class="carousel-item">
                            <img src="<?= asset('ProductImage/' . $productInfor->product_image[$i]) ?>" alt="image" style="object-fit:cover;border-radius:10px" class="d-block  w-100 ">
                        </div>
                <?php }
                } ?>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#carouselExampleIndicators" data-slide="prev" role="button">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" data-slide="next" role="button">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
@stop