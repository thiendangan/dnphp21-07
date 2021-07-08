@extends('layout.frame')
@section('title', 'Category')
@section('editcategory')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Danh mục sản phẩm</h1>
		</div>
	</div>
	<!--/.row-->
	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Sửa danh mục
				</div>
				<div class="panel-body">
					<form class="form-group">
						<label>Tên danh mục:</label>
						<input type="text" name="name" class="form-control" placeholder="Tên danh mục...">
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
@stop