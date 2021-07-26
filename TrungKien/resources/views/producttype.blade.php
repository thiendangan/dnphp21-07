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
					@if ($message = Session::get('success'))
					<div class="alert alert-success" style="margin-top:1rem">
						<strong>{{ $message }}</strong>
					</div>
					@endif
					<form class="form-group" action=" {{ route('producttype.store') }}" method="POST">
						@csrf
						<label>Tên loại:</label>
						<input type="text" required name="ProductType" class="form-control" placeholder="Tên loại sản phẩm...">
						<input type="submit" value="Thêm" class="btn btn-warning" style="margin-top: 1rem;">
					</form>
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
									<th>STT</th>
									<th>Tên loại</th>
									<th style="width:30%">Tùy chọn</th>
								</tr>
							</thead>
							<tbody>
								@foreach($product_types as $product_type)
								<tr>
									<td>{{$index++}}</td>
									<td>{{ $product_type->product_type_name}}</td>
									<td>
										<form action="{{ route('producttype.edit', $product_type->product_type_id)}}" style="display:inline;">
											@csrf
											<button type="submit" class="btn btn-primary">Sửa</button>
										</form>
										<form action="{{ route('producttype.destroy',$product_type->product_type_id)}}" method="POST" style="display:inline;">

											@method('DELETE')
											@csrf
											<button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>

										</form>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<nav aria-label="Page navigation example">
						@if ($product_types->hasPages())
						<ul class="pagination pagination" style="display:block">
							<li><a href="{{$product_types->toArray()['first_page_url']}}" rel="prev">Start</a></li>
							{{-- Previous Page Link --}}

							@if ($product_types->onFirstPage())
							<li class="disabled"><span>Prev</span></li>
							@else
							<li><a href="{{ $product_types->previousPageUrl() }}" rel="prev">Prev</a></li>
							@endif

							@if($product_types->currentPage() > 3)
							<li class="hidden-xs"><a href="{{ $product_types->url(1) }}">1</a></li>
							@endif
							@if($product_types->currentPage() > 4)
							<li><span>...</span></li>
							@endif
							@foreach(range(1, $product_types->lastPage()) as $i)
							@if($i >= $product_types->currentPage() - 2 && $i <= $product_types->currentPage() + 2)
								@if ($i == $product_types->currentPage())
								<li class="active"><span>{{ $i }}</span></li>
								@else
								<li><a href="{{ $product_types->url($i) }}">{{ $i }}</a></li>
								@endif
								@endif
								@endforeach
								@if($product_types->currentPage() < $product_types->lastPage() - 3)
									<li><span>...</span></li>
									@endif
									@if($product_types->currentPage() < $product_types->lastPage() - 2)
										<li class="hidden-xs"><a href="{{ $product_types->url($product_types->lastPage()) }}">{{ $product_types->lastPage() }}</a></li>
										@endif

										{{-- Next Page Link --}}
										@if ($product_types->hasMorePages())
										<li><a href="{{ $product_types->nextPageUrl() }}" rel="next">Next</a></li>
										@else
										<li class="disabled"><span>Next</span></li>
										@endif

										{{-- End Page Link --}}
										<li><a href="{{ $product_types->toArray()['last_page_url'] }}" rel="prev">End</a></li>
						</ul>
						@endif
					</nav>
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