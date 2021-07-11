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
					Sửa danh mục sản phẩm
				</div>
				<div class="panel-body">
					<form class="form-group" action="{{ route('category.update',$categroy_infor->product_category_id)}}" method="POST">
						@csrf
						@method('PUT')
						<div class="form-group">
							<label style="margin-bottom:0.5rem; display:block">Tên danh mục sản phẩm cũ: <span style="font-weight: normal;">{{ $categroy_infor->	product_category_name}}</span> </label>
						</div>
						@if ($errors->has('category_name'))
						<div class="alert alert-danger">
							{{ $errors->first('category_name') }}
						</div>
						@endif
						<div class="form-group">
							<label>Nhập tên danh mục sản phẩm mới</label>
							<input type="text" required name="category_name" class="form-control" placeholder="Tên loại sản phẩm ...">
						</div>

						@if ($errors->has('product_type'))
						<div class="alert alert-danger">
							{{ $errors->first('product_type') }}
						</div>
						@endif
						<label class="form-label">Chọn loại sản phẩm</label>
						<select class="form-control form-control-lg" name="product_type">
							<option selected disabled value="">Loại sản phẩm</option>
							@foreach($list_product_type as $item)
							<option value="{{$item->product_type_id}}">{{$item->product_type_name}}</option>
							@endforeach
						</select>
						<input type="submit" value="Edit" class="btn btn-warning" style="margin-top: 1rem;">
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