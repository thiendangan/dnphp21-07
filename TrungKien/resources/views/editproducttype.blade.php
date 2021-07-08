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
			<div class="panel panel-primary">
				<div class="panel-heading">
					Sửa loại sản phẩm
				</div>
				<div class="panel-body">
					<form class="form-group">
						<label>Tên loại:</label>
						<input type="text" name="name" class="form-control" placeholder="Tên loại sản phẩm ...">
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