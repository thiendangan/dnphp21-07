@extends('layout.frame')
@section('title', 'ProductType')
@section('producttype')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Loại sản phẩm</h1>
		</div>
	</div>
	<!--/.row-->
	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Thêm loại sản phẩm
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label>Tên loại:</label>
						<input type="text" name="name" class="form-control" placeholder="Tên loại sản phẩm...">
						<input type="submit" value="Thêm" class="btn btn-warning" style="margin-top: 1rem;">
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-12 col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">Danh sách loại sản phẩm</div>
				<div class="panel-body">
					<div class="bootstrap-table">
						<table class="table table-bordered">
							<thead>
								<tr class="bg-primary">
									<th>Tên loại</th>
									<th style="width:30%">Tùy chọn</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>iPhone</td>
									<td>
										<a href="<?= route('producttype.edit',1)?>" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Sửa</a>
										<a href="#" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Xóa</a>
									</td>
								</tr>
								<tr>
									<td>Samsung</td>
									<td>
										<a href="<?= route('producttype.edit',1)?>" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Sửa</a>
										<a href="#" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Xóa</a>
									</td>
								</tr>
								<tr>
									<td>Nokia</td>
									<td>
										<a href="<?= route('producttype.edit',1)?>" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Sửa</a>
										<a href="#" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Xóa</a>
									</td>
								</tr>
								<tr>
									<td>HTC</td>
									<td>
										<a href="<?= route('producttype.edit',1)?>" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Sửa</a>
										<a href="#" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Xóa</a>
									</td>
								</tr>
								<tr>
									<td>LG</td>
									<td>
										<a href="<?= route('producttype.edit',1)?>" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Sửa</a>
										<a href="#" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Xóa</a>
									</td>
								</tr>
								<tr>
									<td>Sony</td>
									<td>
										<a href="<?= route('producttype.edit',1)?>" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Sửa</a>
										<a href="#" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Xóa</a>
									</td>
								</tr>
								<tr>
									<td>Motorola</td>
									<td>
										<a href="<?= route('producttype.edit',1)?>" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Sửa</a>
										<a href="#" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Xóa</a>
									</td>
								</tr>
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