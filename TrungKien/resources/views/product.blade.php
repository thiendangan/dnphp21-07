@extends('layout.frame')
@section('title', 'Product')
@section('product')
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
				<div class="panel-heading">Danh sách sản phẩm</div>
				<div class="panel-body">
					<div class="bootstrap-table">
						<a href="<?= route('product.create') ?>" class="btn btn-primary">Thêm sản phẩm</a>
						@if ($message = Session::get('success'))
						<div class="alert edit alert-success" style="margin-top: 1rem;margin-bottom:-1rem">
							<strong>{{ $message }}</strong>
						</div>
						@endif
						<div class="table-responsive">
							<table class="table table-bordered" style="margin-top:20px;">
								<thead>
									<tr class="bg-primary">
										<th scope="col" style="width: 7%;">STT</th>
										<th scope="col" style="width: 15%;">Tên Sản phẩm</th>
										<th scope="col" style="width: 10%;">Mã sản phẩm</th>
										<th scope="col" style="width: 15%;">Danh mục sản phẩm</th>
										<th scope="col" style="width: 20%;">Ảnh đại diện</th>
										<th scope="col" style="width: 10%;">Giá</th>
										<th scope="col" style="width: 10%;">Tùy chọn</th>
									</tr>
								</thead>
								<tbody>
									@foreach( $products as $product)
									<tr>
										<td>{{ $index++}}</td>
										<td>{{ $product->product_name}}</td>
										<td>{{ $product->product_id}}</td>
										<td>{{ $product->product_category_name}}</td>
										<td>
											<img width="150px" height="100px" src="<?= asset('ProductImage/' . $product->product_image[0]) ?>" class="thumbnail" style="border:none !important;margin: 0 auto; object-fit:cover">
										</td>
										<td>{{ number_format($product->product_price) }} Đ</td>
										<td style="display:flex;flex-direction:column;border:none">
											<a href="<?= route('product.edit', $product->product_id) ?>" class="btn btn-warning" style="margin-bottom:0.7rem !important"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
											<form action="{{ route('product.destroy',$product->product_id)}}" method="POST">
												@method('DELETE')
												@csrf
												<button type="submit" class="btn btn-danger form-control" style="margin-bottom:0.7rem !important" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</button>
											</form>
											<a href="<?= route('product.show', $product->product_id) ?>" class="btn btn-success" style="margin-bottom:0.7rem !important"><i class="fa fa-trash" aria-hidden="true"></i> Chi tiết</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<nav aria-label="Page navigation example">
								@if ($products->hasPages())
								<ul class="pagination pagination" style="display:block">
									<li><a href="{{$products->toArray()['first_page_url']}}" rel="prev">Start</a></li>
									{{-- Previous Page Link --}}

									@if ($products->onFirstPage())
									<li class="disabled"><span>Prev</span></li>
									@else
									<li><a href="{{ $products->previousPageUrl() }}" rel="prev">Prev</a></li>
									@endif

									@if($products->currentPage() > 3)
									<li class="hidden-xs"><a href="{{ $products->url(1) }}">1</a></li>
									@endif
									@if($products->currentPage() > 4)
									<li><span>...</span></li>
									@endif
									@foreach(range(1, $products->lastPage()) as $i)
									@if($i >= $products->currentPage() - 2 && $i <= $products->currentPage() + 2)
										@if ($i == $products->currentPage())
										<li class="active"><span>{{ $i }}</span></li>
										@else
										<li><a href="{{ $products->url($i) }}">{{ $i }}</a></li>
										@endif
										@endif
										@endforeach
										@if($products->currentPage() < $products->lastPage() - 3)
											<li><span>...</span></li>
											@endif
											@if($products->currentPage() < $products->lastPage() - 2)
												<li class="hidden-xs"><a href="{{ $products->url($products->lastPage()) }}">{{ $products->lastPage() }}</a></li>
												@endif

												{{-- Next Page Link --}}
												@if ($products->hasMorePages())
												<li><a href="{{ $products->nextPageUrl() }}" rel="next">Next</a></li>
												@else
												<li class="disabled"><span>Next</span></li>
												@endif
												
												{{-- End Page Link --}}
												<li><a href="{{ $products->toArray()['last_page_url'] }}" rel="prev">End</a></li>
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