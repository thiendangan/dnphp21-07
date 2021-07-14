<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    
    <link rel="stylesheet" href="<?= asset('css/client.css') ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    
</head>

<body>

    <div class="container">
        <div class="header row">
            <div class="col-lg-5 col-md-4 col-sm-12">
                <h3>NCC Company</h3>
            </div>
            <form class="search col-lg-7 col-md-8 col-sm-12">
                <select class="form-control">
                    <option selected disabled>Loại sản phẩm</option>
                    @foreach($productTypes as $item)
                    <option value="{{$item->product_type_id}}">{{$item->product_type_name}}</option>
                    @endforeach
                </select>
                <select class="form-control">
                    <option selected disabled>Danh mục sản phẩm</option>
                    @foreach($categories as $item)
                    <option value="{{$item->product_category_id}}">{{$item->product_category_name}}</option>
                    @endforeach
                </select>
                <label for="" class="form-control"><input type="search" class="search_field" placeholder="Bạn tìm gì ?" style="border: none;outline: none;width: 100%;"></label>
            </form>
        </div>
        <div class="row clearfix">
            @foreach($products as $item)
            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="card product_item">
                    <div class="body">
                        <div class="cp_img">
                            <img src="{{ asset('ProductImage/'.$item->product_image[0]) }}" alt="Product" class="img-fluid">
                        </div>
                        <div class="product_details">
                            <h5><a href="ec-product-detail.html">{{$item->product_name}}</a></h5>
                            <ul class="product_price list-unstyled">
                                <li class="product_price">{{ number_format( $item->product_price )}} VNĐ</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <nav aria-label="...">
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
                <li class="hidden-xs page-item"><a  class="page-link" href="{{ $products->url(1) }}">1</a></li>
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
                            <li class="disabled page-item"><span class="page-link" >Next</span></li>
                            @endif

                            {{-- End Page Link --}}
                            <li class="page-item"><a class="page-link" href="{{ $products->toArray()['last_page_url'] }}" rel="prev">End</a></li>
            </ul>
            @endif
        </nav>
    </div>
    <footer>
        NCC Company &copy; 2021
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>