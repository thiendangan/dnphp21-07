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
				<div class="panel-heading">Thêm sản phẩm</div>
				<div class="panel-body">
					@if ( $message = Session::get('success'))
					<div class="alert edit alert-success">
						<strong>{{ $message }}</strong>
					</div>
					@endif
					<form method="POST" id="EditProduct_form" enctype="multipart/form-data" action="{{ route('product.update',$productInfor->product_id)}}">
						@method('PUT')
						@csrf
						<div class="row" style="margin-bottom:40px">
							<div class="col-md-12 col-lg-6">
								@if ($errors->has('ProductName'))
								<div class="alert edit alert-danger">
									{{ $errors->first('ProductName') }}
								</div>
								@endif
								<div class="form-group">
									<label style="display: block;">Tên sản phẩm</label>
									<input type="text" value="{{$productInfor->product_name}}" required name="ProductName" class="form-control" placeholder="Nhập tên sản phẩm">
								</div>
								@if ($errors->has('Productprice'))
								<div class="alert edit alert-danger">
									{{ $errors->first('Productprice') }}
								</div>
								@endif
								<div class="form-group">
									<label style="display: block;">Giá sản phẩm</label>
									<input required type="number" value="{{$productInfor->product_price}}" name="Productprice" class="form-control" placeholder="Nhập giá sản phẩm">
								</div>

								@if ($errors->has('ProductType'))
								<div class="alert edit alert-danger">
									{{ $errors->first('ProductType') }}
								</div>
								@endif
								<div class="form-group">
									<label style="display: block;">Loại sản phẩm</label>
									<select class="form-control" name="ProductType" id="EditProductType" required>
										<option disabled selected>Chọn loại sản phẩm</option>
										@foreach($ProductTypes as $item)
										<option value="{{ $item->product_type_name}}" <?php if ($item->product_type_name === $productInfor->product_type_name) echo 'selected' ?>>{{$item->product_type_name}}</option>
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
									<select required class="form-control" name="ProductCategory" id="EditCategory">
										<option value="{{$productInfor->product_category_id}}" selected>{{ $productInfor->product_category_name }}</option>
									</select>
								</div>

								@if ($errors->has('Description'))
								<div class="alert alert-danger">
									{{ $errors->first('Description') }}
								</div>
								@endif
								<div class="form-group">
									<label style="display: block;">Miêu tả</label>
									<textarea required name="Description" class="form-control" placeholder="Miêu tả sản phẩm">{{ $productInfor->product_description}}</textarea>
								</div>
							</div>
							<div class="col-md-12 col-lg-6">
								<h3 class="text-center">Click để cập nhật hình ảnh cho sản phẩm</h3>
								@if ($errors->has('ProductImage.0'))
								<div class="alert alert-danger">
									{{ $errors->first('ProductImage') }}
								</div>
								@elseif($errors->has('ProductImage'))
								<div class="alert alert-danger">
									{{ $errors->first('ProductImage') }}
								</div>
								@endif
								<div class="row update_image" style="padding-top: 2rem;">
									@foreach($productInfor->product_image as $item)
									@if(!empty($item))
									<input type="text" class="temp" name="backEndImages[]" hidden value="{{$item}}">
									@endif
									@endforeach
									
									@for($i=1;$i<=4;$i++)
									<div class="Edit_image ">
										<label for="edit_image{{$i}}"><img src="<?php if (!empty($productInfor->product_image[$i-1])) {
																				echo asset('ProductImage/' . $productInfor->product_image[$i-1]);
																			} else {
																				echo asset('ProductImage/plus1.jpg');
																			} ?> " alt="" width="130px" height="130px" style="border:1px solid #333;object-fit:cover"></label>
										<input id="edit_image{{$i}}" type="file" name="ProductImageUpdate[]" class="form-control images" accept="image/png, image/jpeg,image/jpg" style="display:none;object-fit:cover">
									</div>
									@endfor
								</div>
							</div>
							<div class="col-md-12 col-lg-12">
								<div class="row">
									<div class="col-md-12 col-lg-6">
										<input type="submit" name="submit" value="Edit" class="btn btn-primary form-control" style="margin-top:1rem">
									</div>
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
@stop