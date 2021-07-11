@extends('layout.frame')
@section('title', 'ProductDetail')
@section('detailproduct')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Sản phẩm</h1>
		</div>
	</div>
	<!--/.row-->
	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-6">
			<div class="panel panel-primary" style="padding-bottom:1rem; overflow:auto; height:403px;">
				<div class="panel-heading">
					Chi tiết sản phẩm
				</div>
				<div  style="margin-top :2rem;margin-left: 2rem;">
					<h4 style="display: block;font-weight: bold;margin-top :2rem;"> {{ $product_infor->product_name}} </h4>
					<label style="display: block;" class="form-label"> Mã sản phẩm: <span style="font-weight: normal; margin:0.5rem 0" >{{ $product_infor->product_id }}</span></label>
					<label style="display: block;"> Loại sản phẩm: <span style="font-weight: normal; margin:0.5rem 0">{{ $product_infor->ProductTypeName }}</span></label>
					<label style="display: block;"> Danh mục sản phẩm: <span style="font-weight: normal; margin:0.5rem 0">{{ $product_infor->CategoryName }}</span></label>
					<label style="display: block;"> Giá : <span style="font-weight: normal; margin:0.5rem 0">{{ $product_infor->product_price }}</span"></span></label>
					<label style="display: block;">Mô tả:</label>
					<p>{{ $product_infor->product_description}}</p>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-12 col-lg-6">
			<div class="panel panel-primary" >
				<div class="panel-heading">Slide</div>
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<?php for ($i = 2; $i < count($product_infor->product_image); $i++) { ?>
							<li data-target="#myCarousel" data-slide-to="<?= $i ?>"></li>
						<?php } ?>
					</ol>
					<!-- Wrapper for slides -->
					<div class="carousel-inner" style="height: 100%;">
						<div class="item active">
							<img src="<?= asset('ProductImage/' . $product_infor->product_image[0]) ?>" alt="image" style="object-fit:cover">
						</div>
						<?php for ($i = 1; $i < count($product_infor->product_image); $i++) {
							if (!empty($product_infor->product_image[$i])) { ?>
								<div class=" item">
									<img src="<?= asset('ProductImage/' . $product_infor->product_image[$i]) ?>" alt="image" style="object-fit:cover">
								</div>
						<?php }
						} ?>
					</div>

					<!-- Left and right controls -->
					<a class=" left carousel-control" href="#myCarousel" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#myCarousel" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
	</div>
	<!--/.row-->
	<footer class="detail_product">
		NCC Company &copy; 2021
	</footer>
</div>
<!--/.main-->
@stop