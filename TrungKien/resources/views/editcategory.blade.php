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
			<div class="panel panel-primary" style="min-height: 67vh;">
				<div class="panel-heading">
					Sửa danh mục sản phẩm
				</div>
				<div class="panel-body">
					<form class="form-group" action="{{ route('category.update',$categroyInfor->product_category_id)}}" method="POST">
						@csrf
						@method('PUT')
						@if ($errors->has('categoryName'))
						<div class="alert alert-danger">
							{{ $errors->first('categoryName') }}
						</div>
						@endif
						<div class="form-group">
							<label>Tên danh mục sản phẩm</label>
							<input type="text" required name="categoryName" class="form-control" value="{{$categroyInfor->product_category_name}}">
						</div>

						@if ($errors->has('productType'))
						<div class="alert alert-danger">
							{{ $errors->first('productType') }}
						</div>
						@endif
						<label class="form-label">Chọn loại sản phẩm</label>
						<select class="form-control form-control-lg" name="productType">
							<option selected disabled value="">Loại sản phẩm</option>
							@foreach($productTypes as $item)
							<option value="{{$item->product_type_id}}" <?php if($item->product_type_id == $categroyInfor->product_type_id) echo "selected"?>>{{$item->product_type_name}}</option>
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