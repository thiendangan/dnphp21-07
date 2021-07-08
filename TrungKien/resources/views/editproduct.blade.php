@extends('layout.frame')
@section('title', 'ProductEdit')
@section('editproduct')

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
				<div class="panel-heading">Sửa sản phẩm</div>
				<div class="panel-body">
					<form method="post" enctype="multipart/form-data">
						<div class="row" style="margin-bottom:40px">
							<div class="col-xs-8">
								<div class="form-group">
									<label>Tên sản phẩm</label>
									<input required type="text" name="name" class="form-control">
								</div>
								<div class="form-group">
									<label>Giá sản phẩm</label>
									<input required type="number" name="price" class="form-control">
								</div>
								<div class="form-group">
									<label>Loại sản phẩm</label>
									<select class="form-control">
										<option selected disabled value="">Loại sản phẩm</option>
										<option value="1">One</option>
										<option value="2">Two</option>
										<option value="3">Three</option>
									</select>
								</div>
								<div class="form-group">
									<label>Danh mục sản phẩm</label>
									<select class="form-control">
										<option selected disabled value="">Danh mục sản phẩm</option>
										<option value="1">One</option>
										<option value="2">Two</option>
										<option value="3">Three</option>
									</select>
								</div>

								<div class="form-group">
									<label>Miêu tả</label>
									<textarea required name="description" class="form-control" placeholder="Miêu tả sản phẩm"></textarea>
								</div>
								<div class="form-group">
									<label>Ảnh sản phẩm</label>
									<input required id="img" type="file" name="img" class="form-control hidden" onchange="changeImg(this)">
									<label for=""><img id="avatar" class="thumbnail" width="150px" src="<?= asset('img/new_seo-10-512.png')?>" style="display: inline;">
										<img id="avatar" class="thumbnail" width="150px" src="<?= asset('img/new_seo-10-512.png')?>" style="display: inline;">
										<img id="avatar" class="thumbnail" width="150px" src="<?= asset('img/new_seo-10-512.png')?>" style="display: inline;">
										<img id="avatar" class="thumbnail" width="150px" src="<?= asset('img/new_seo-10-512.png')?>" style="display: inline;"></label>

								</div>
								<input type="submit" name="submit" value="Thêm" class="btn btn-primary">
								<a href="#" class="btn btn-danger">Hủy bỏ</a>
							</div>
						</div>
					</form>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!--/.row-->
</div>
@stop