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

	<div class="row" >
		<div class="col-xs-12 col-md-12 col-lg-12" >
			<div class="panel panel-primary"  style="padding-bottom: 1rem ; height:100%;">
				<div class="panel-heading">
					Chi tiết sản phẩm
				</div>
				<div class="form-group" style="margin-top :2rem;margin-left: 2rem;">
					<h4 style="display: block;font-weight: bold;margin-top :2rem;"> Sản phẩm A </h4>
					<label style="display: block;"> Mã sản phẩm: <span style="font-weight: normal;">4DA41</span></label>
					<label style="display: block;"> Loại sản phẩm: <span style="font-weight: normal;">Áo</span></label>
					<label style="display: block;"> Danh mục sản phẩm: <span style="font-weight: normal;">Áo len</span></label>
					<label style="display: block;"> Giá : <span style="font-weight: normal;">132465465</span"></span></label>
					<label style="display: block;">Mô tả:</label>
					<p>Sản phẩm này tốt lắm</p>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-12 col-lg-12">
			<div class="panel panel-primary" >
				<div class="panel-heading">Slide</div>
				<div id="myCarousel" class="carousel slide" data-ride="carousel" >
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner">
						<div class="item active">
							<img src="<?= asset('img/anh nền.jpg')?>" alt="Los Angeles"  ">
						</div>

						<div class="item">
							<img src="<?= asset('img/upload-cloud.png')?>" alt="Chicago"  ">
						</div>

						<div class="item">
							<img src="<?= asset('img/upload-cloud.png')?>" alt="New York" ">
						</div>
					</div>

					<!-- Left and right controls -->
					<a class="left carousel-control" href="#myCarousel" data-slide="prev">
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
	<footer>
        NCC Company &copy; 2021
    </footer>
</div>
<!--/.main-->
@stop