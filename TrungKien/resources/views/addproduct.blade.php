@extends('layout.frame')
@section('title', 'ProductAdd')
@section('addproduct')
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
				<div class="panel-heading">Thêm sản phẩm</div>
				<div class="panel-body">
					@if ($message = Session::get('success'))
					<div class="alert alert-success">
						<strong>{{ $message }}</strong>
					</div>
					@endif
					<form method="POST" id="addProduct_form" enctype="multipart/form-data" action="{{ route('product.store') }}">
						@csrf
						<div class="row" style="margin-bottom:40px">
							<div class="col-md-12 col-lg-8">
								@if ($errors->has('ProductName'))
								<div class="alert alert-danger">
									{{ $errors->first('ProductName') }}
								</div>
								@endif
								<div class="form-group">
									<label style="display: block;">Tên sản phẩm</label>
									<input type="text" required name="ProductName" class="form-control" placeholder="Nhập tên sản phẩm">
								</div>
								@if ($errors->has('Productprice'))
								<div class="alert alert-danger">
									{{ $errors->first('Productprice') }}
								</div>
								@endif
								<div class="form-group">
									<label style="display: block;">Giá sản phẩm</label>
									<input required type="number" name="Productprice" class="form-control" placeholder="Nhập giá sản phẩm">
								</div>

								@if ($errors->has('ProductType'))
								<div class="alert alert-danger">
									{{ $errors->first('ProductType') }}
								</div>
								@endif
								<div class="form-group">
									<label style="display: block;">Loại sản phẩm</label>
									<select class="form-control" name="ProductType" id="addProductType" required>
										<option disabled selected>Chọn loại sản phẩm</option>
										@foreach($ProductTypes as $item)
										<option value="{{ $item->product_type_name}} ">{{$item->product_type_name}}</option>
										@endforeach
									</select>
								</div>

								@if ($errors->has('ProductCategory'))
								<div class="alert alert-danger">
									{{ $errors->first('ProductCategory') }}
								</div>
								@endif
								<div class="form-group">
									<label style="display: block;">Danh mục sản phẩm</label>
									<select required class="form-control" name="ProductCategory" id="addCategory">
										<option disabled selected>Chọn Danh mục sản phẩm</option>
									</select>
								</div>

								@if ($errors->has('Description'))
								<div class="alert alert-danger">
									{{ $errors->first('Description') }}
								</div>
								@endif
								<div class="form-group">
									<label style="display: block;">Miêu tả</label>
									<textarea required name="Description" class="form-control" placeholder="Miêu tả sản phẩm"></textarea>
								</div>

								@if ($errors->has('ProductImage.0'))
								<div class="alert alert-danger">
									{{ $errors->first('ProductImage.0') }}
								</div>
								@elseif($errors->has('ProductImage'))
								<div class="alert alert-danger">
									{{ $errors->first('ProductImage') }}
								</div>
								@endif
								<div class="form-group">
									<label style="display: block;">Ảnh sản phẩm</label>
									<input id="img" required type="file" name="ProductImage[]" class="form-control" multiple accept="image/png, image/jpeg,image/jpg" style="display:none">
									<label for="img" id="represent_image" class="btn btn-success" style="margin-bottom: 1rem">Chọn ảnh sản phẩm</label>
									<div id="all_images">

									</div>
									<input type="submit" id="submit_product" name="submit" value="Thêm" class="btn btn-primary">
									<a href="#" class="btn btn-danger" id="form_reset">Reset</a>
								</div>
							</div>
						</div>
					</form>
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