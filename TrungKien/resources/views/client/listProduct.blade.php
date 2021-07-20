@extends('client.frame')
@section('home')

<div class="header row">
    <div class="col-lg-3 col-md-4 col-sm-12">
        <a href="/">Phạm Trung Kiên</a>
    </div>
    <form class="search col-lg-9 col-md-8 col-sm-12">
        <select class="form-control" id="productTypes">
            <option selected value="default">Tất cả loại sản phẩm</option>
            @foreach($productTypes as $item)
            <option value="{{$item->product_type_id}}">{{ $item->product_type_name}}</option>
            @endforeach
        </select>
        <select class="form-control" id="category">
            <option selected value="default">Tất cả danh mục sản phẩm</option>
        </select>
        <label for="" class="form-control"><input type="search" id="searchText" class="search_field" placeholder="Bạn tìm gì ?" style="border: none;outline: none;width: 100%;"></label>
    </form>
</div>
<div class="row clearfix" id="listProduct">
    @foreach($products as $item)
    <div class="col-lg-3 col-md-4 col-sm-12">
        <a href="{{route('detailProduct',$item->product_id)}}">
            <div class="card product_item">
                <div class="body">
                    <div class="cp_img">
                        <img src="{{ asset('ProductImage/'.$item->product_image[0]) }}" alt="Product" class="img-fluid">
                    </div>
                    <div class="product_details">
                        <h5><a href="{{route('detailProduct',$item->product_id)}}">{{$item->product_name}}</a></h5>
                        <ul class="product_price list-unstyled">
                            <li class="product_price">{{ number_format( $item->product_price )}} VNĐ</li>
                        </ul>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
<nav aria-label="..." id="pagination">
    @if ($products->hasPages())
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="{{$products->toArray()['first_page_url']}}" rel="prev">Start</a></li>
        {{-- Previous Page Link --}}

        @if ($products->onFirstPage())
        <li class="page-item disabled"><span class="page-link">Prev</span></li>
        @else
        <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev">Prev</a></li>
        @endif

        @if($products->currentPage() > 3)
        <li class="hidden-xs page-item"><a class="page-link" href="{{ $products->url(1) }}">1</a></li>
        @endif
        @if($products->currentPage() > 4)
        <li class="page-item"><span>...</span></li>
        @endif
        @foreach(range(1, $products->lastPage()) as $i)
        @if($i >= $products->currentPage() - 2 && $i <= $products->currentPage() + 2)
            @if ($i == $products->currentPage())
            <li class="active page-item"><span class="page-link">{{ $i }}</span></li>
            @else
            <li class="page-item"><a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a></li>
            @endif
            @endif
            @endforeach
            @if($products->currentPage() < $products->lastPage() - 3)
                <li class="page-item"><span class="page-link">...</span></li>
                @endif
                @if($products->currentPage() < $products->lastPage() - 2)
                    <li class="hidden-xs page-item"><a class="page-link" href="{{ $products->url($products->lastPage()) }}">{{ $products->lastPage() }}</a></li>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($products->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next">Next</a></li>
                    @else
                    <li class="disabled page-item"><span class="page-link">Next</span></li>
                    @endif

                    {{-- End Page Link --}}
                    <li class="page-item"><a class="page-link" href="{{ $products->toArray()['last_page_url'] }}" rel="prev">End</a></li>
    </ul>
    @endif
</nav>

@stop