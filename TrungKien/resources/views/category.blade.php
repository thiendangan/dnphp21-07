@extends('layout.frame')
@section('title', 'Category')
@section('category')
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
					Thêm danh mục
				</div>
				<div class="panel-body">
					@if ($message = Session::get('success'))
					<div class="alert alert-success">
						<strong>{{ $message }}</strong>
					</div>
					@endif
					<form class="form-group" method="POST" action="{{ route('category.store')}}">
						@if ($errors->has('product_type'))
						<div class="alert alert-danger">
							{{ $errors->first('product_type') }}
						</div>
						@endif
						<label>Loại sản phẩm</label>
						@csrf
						<select class="form-control" name="productType">
							<option selected disabled value="">Loại sản phẩm</option>
							@foreach($productTypes as $item)
							<option value="{{$item->product_type_id}}">{{$item->product_type_name}}</option>
							@endforeach
						</select>

						@if ($errors->has('categoryName'))
						<div class="alert alert-danger">
							{{ $errors->first('categoryName') }}
						</div>
						@endif
						<div class="form-group">
							<label>Tên danh mục:</label>
							<input type="text" name="categoryName" class="form-control" placeholder="Tên danh mục...">
							<input type="submit" value="Thêm" class="btn btn-warning" style="margin-top: 1rem;">
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-12 col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">Danh sách danh mục</div>
				<div class="panel-body">
					<div class="bootstrap-table">
						<table class="table table-bordered">
							<thead>
								<tr class="bg-primary">
									<th>STT</th>
									<th>Tên danh mục</th>
									<th style="width:30%">Tùy chọn</th>
								</tr>
							</thead>
							<tbody>
								@foreach($productCategories as $item)
								<tr>
									<td>{{$index++}}</td>
									<td>{{$item->product_category_name}}</td>
									<td>
										<form action="{{ route('category.edit', $item->product_category_id )}}" style="display:inline;">
											@csrf
											<button type="submit" class="btn btn-primary">Sửa</button>
										</form>
										<form action="{{ route('category.destroy',$item->product_category_id)}}" method="POST" style="display:inline;">
											@method('DELETE')
											@csrf
											<button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
										</form>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<nav aria-label="Page navigation example">
							@if ($productCategories->hasPages())
							<ul class="pagination pagination" style="display:block">
								<li><a href="{{$productCategories->toArray()['first_page_url']}}" rel="prev">Start</a></li>
								{{-- Previous Page Link --}}

								@if ($productCategories->onFirstPage())
								<li class="disabled"><span>Prev</span></li>
								@else
								<li><a href="{{ $productCategories->previousPageUrl() }}" rel="prev">Prev</a></li>
								@endif

								@if($productCategories->currentPage() > 3)
								<li class="hidden-xs"><a href="{{ $productCategories->url(1) }}">1</a></li>
								@endif
								@if($productCategories->currentPage() > 4)
								<li><span>...</span></li>
								@endif
								@foreach(range(1, $productCategories->lastPage()) as $i)
								@if($i >= $productCategories->currentPage() - 2 && $i <= $productCategories->currentPage() + 2)
									@if ($i == $productCategories->currentPage())
									<li class="active"><span>{{ $i }}</span></li>
									@else
									<li><a href="{{ $productCategories->url($i) }}">{{ $i }}</a></li>
									@endif
									@endif
									@endforeach
									@if($productCategories->currentPage() < $productCategories->lastPage() - 3)
										<li><span>...</span></li>
										@endif
										@if($productCategories->currentPage() < $productCategories->lastPage() - 2)
											<li class="hidden-xs"><a href="{{ $productCategories->url($productCategories->lastPage()) }}">{{ $productCategories->lastPage() }}</a></li>
											@endif

											{{-- Next Page Link --}}
											@if ($productCategories->hasMorePages())
											<li><a href="{{ $productCategories->nextPageUrl() }}" rel="next">Next</a></li>
											@else
											<li class="disabled"><span>Next</span></li>
											@endif

											{{-- End Page Link --}}
											<li><a href="{{ $productCategories->toArray()['last_page_url'] }}" rel="prev">End</a></li>
							</ul>
							@endif
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