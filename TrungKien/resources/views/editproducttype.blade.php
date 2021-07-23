@extends('layout.frame')
@section('title', 'ProductType')
@section('editproducttype')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"> Loại sản phẩm</h1>
		</div>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12">
			<div class="panel panel-primary" style="min-height: 67vh;">
				<div class="panel-heading">
					Sửa loại sản phẩm
				</div>
				<div class="panel-body">
					<form class="form-group" action="{{ route('producttype.update',$product_type_name->product_type_id )}}" method="POST" >
						@csrf
						@method('PUT')
						<label style="margin-bottom:0.5rem; display:block" class="form-control">Tên loại sản phẩm cũ: <span style="font-weight: 500;">{{ $product_type_name->product_type_name}}</span> </label>
						<label class="form-control">Nhập tên loại sản phẩm mới</label>
						<input type="text" required name="ProductType" class="form-control" placeholder="Tên loại sản phẩm ...">
						<input type="submit" value="Submit" class="btn btn-warning" style="margin-top: 1rem;">
					</form>
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