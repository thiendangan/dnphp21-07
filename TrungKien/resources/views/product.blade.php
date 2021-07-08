@extends('layout.frame')
@section('title', 'Product')
@section('product')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Sản phẩm</h1>
		</div>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12">

			<div class="panel panel-primary">
				<div class="panel-heading">Danh sách sản phẩm</div>
				<div class="panel-body">
					<div class="bootstrap-table">
						<a href="<?= route('product.create') ?>" class="btn btn-primary">Thêm sản phẩm</a>
						<div class="table-responsive">
							<table class="table table-bordered" style="margin-top:20px;">
								<thead>
									<tr class="bg-primary">
										<th scope="col" style="width: 7%;">STT</th>
										<th scope="col" style="width: 15%;">Tên Sản phẩm</th>
										<th scope="col" style="width: 10%;">Mã sản phẩm</th>
										<th scope="col" style="width: 15%;">Danh mục sản phẩm</th>
										<th scope="col" style="width: 20%;">Ảnh đại diện</th>
										<th scope="col" style="width: 10%;">Giá</th>
										<th scope="col" style="width: 10%;">Tùy chọn</th>
									</tr>
								</thead>
								<tbody>
									@foreach ( $products as $products)
									<tr>
										<td>{{ $i++}}</td>
										<td>{{ $products->product_name}}</td>
										<td>{{ $products->product_id}}</td>
										<td>{{ $products->product_category_name}}</td>
										<td>
											<img width="90%" src="<?= asset('img/iphone7-plus-black-select-2016.jpg') ?>" class="thumbnail" style="border:none !important;margin: 0 auto">
										</td>
										<td>{{ $products->product_price }} Đ</td>
										<td style="display:flex;flex-direction:column;border:none">
											<a href="<?= route('product.edit', $products->product_id) ?>" class="btn btn-warning" style="margin-bottom:0.7rem !important"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
											<a href="<?= route('product.destroy',$products->product_id ) ?>" class="btn btn-danger" style="margin-bottom:0.7rem !important"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
											<a href="<?= route('product.show', $products->product_id) ?>" class="btn btn-success" style="margin-bottom:0.7rem !important"><i class="fa fa-trash" aria-hidden="true"></i> Chi tiết</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							<nav aria-label="Page navigation example">
								<ul class="pagination  manage_product">
									<li class="page-item"><a class="page-link " href="#">Start</a></li>
									<li class="page-item"><a class="page-link" href="#">Previous</a></li>
									<li class="page-item"><a class="page-link active" href="#">1</a></li>
									<li class="page-item"><a class="page-link" href="#">2</a></li>
									<li class="page-item"><a class="page-link" href="#">3</a></li>
									<li class="page-item"><a class="page-link" href="#">Next</a></li>
									<li class="page-item"><a class="page-link" href="#">End</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="clearfix"></div>
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