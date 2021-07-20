<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        @yield('home')
        @yield('detailProduct')

        <footer>
            NCC Company &copy; 2021
        </footer>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script>
        const imageDomain = 'http://127.0.0.1:8000/ProductImage/';

        // Get all products folowwing ProductType and load category relative with that ProductType
        $('#productTypes').on('change', function() {
            if ($('#productTypes').val() === 'default') {
                $('#category').html('` <option selected value="default">Tất cả danh mục sản phẩm</option>`');
            }
            $.ajax({
                type: 'POST',
                url: "<?= route('searchProducts') ?>",
                data: {
                    productType: $('#productTypes').val(),
                    category: $('#category').val(),
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    response = JSON.parse(response);
                    if ($('#productTypes').val() != 'default') {
                        var categories = `<option selected value="default">Tất cả danh mục sản phẩm</option>`;
                        for (const element of response.categories) {
                            categories += `"<option value="${element.product_category_id }">${element.product_category_name}</option>"`
                        }
                        $("#category").html(categories);
                        categories = "";
                    }
                    $('#listProduct').html(loadListProducts(response.products));
                    $('#pagination').html(loadPagination(response.products));
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    //xử lý lỗi tại đây
                }
            })
        });

        // Get all products following ProductType and Category.
        $('#category').on('change', function() {
            callAjaxToGetProducts($('#searchText').val());
        });

        // Paginating for products
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            callAjaxToGetProducts($('#searchText').val(), page);
        });

        // Get all products rely on the text on search input
        $('#searchText').on('keyup', function() {
            callAjaxToGetProducts($('#searchText').val());
        })

        // function call Ajax to get Producst from information like: productType,category,pagination,search text.
        function callAjaxToGetProducts(searchText, page) {
            $.ajax({
                type: 'POST',
                url: "<?= route('searchProducts') ?>",
                data: {
                    productType: $('#productTypes').val(),
                    category: $('#category').val(),
                    searchText: searchText,
                    page: page,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.products.data.length > 0) {
                        $('#listProduct').html(loadListProducts(response.products));
                    } else
                        $('#listProduct').html('<p>Không có sản phẩm nào được tìm thấy</p>');
                    $('#pagination').html(loadPagination(response.products));

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    //xử lý lỗi tại đây
                }
            })
        }

        // function load products to user interface from result returned by Ajax call
        function loadListProducts(response) {
            var products = "";
            for (const element of response.data) {
                products += `<div class="col-lg-3 col-md-4 col-sm-12">
                                  <a href="/detailProduct/${element.product_id}">
                                        <div class="card product_item">
                                            <div class="body">
                                                <div class="cp_img">
                                                    <img src="${imageDomain+element.product_image[0]}" alt="Product" class="img-fluid">
                                                </div>
                                                <div class="product_details">
                                                    <h5><a href="/detailProduct/${element.product_id}">${element.product_name}</a></h5>
                                                    <ul class="product_price list-unstyled">
                                                        <li class="product_price"> ${new Intl.NumberFormat().format(element.product_price)} VNĐ</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    </div>`;
            }
            return products;
        }

        // function load products to user interface rely on every pagination from result returned by Ajax call
        function loadPagination(response) {
            var pagination = "";
            if (response.last_page > 1) {
                pagination += `<ul class="pagination">
                            <li class="page-item"><a class="page-link" href="${response.first_page_url}" rel="prev">Start</a></li>`;
                if (response.from == 1) {
                    pagination += `<li class="page-item disabled"><span class="page-link">Prev</span></li>`;
                } else {
                    pagination += `<li class="page-item"><a class="page-link" href="${response.prev_page_url}" rel="prev">Prev</a></li>`;
                }

                if (response.current_page > 3) {
                    pagination += `<li class="hidden-xs page-item"><a class="page-link" href="${response.links[1].url}">1</a></li>`;
                }
                if (response.current_page > 4) {
                    pagination += `<li class="page-item"><span>...</span></li>`;
                }
                for (let i = 1; i <= response.last_page; i++) {
                    if (i >= response.current_page - 2 && i <= response.current_page + 2) {
                        if (i == response.current_page) {
                            pagination += ` <li class="active page-item"><span class="page-link">${i}</span></li>`;
                        } else {
                            pagination += `<li class="page-item"><a class="page-link" href="${response.links[i].url}">${i}</a></li>`;
                        }
                    }
                }
                if (response.current_page < response.last_page - 3) {
                    pagination += ` <li class="page-item"><span class="page-link">...</span></li>`;
                }
                if (response.current_page < response.last_page - 2) {
                    pagination += ` <li class="hidden-xs page-item"><a class="page-link" href="${response.links[response.last_page].url}">${response.last_page}</a></li>`;
                }
                if (response.last_page > response.current_page) {
                    pagination += ` <li class="page-item"><a class="page-link" href="${response.next_page_url}" rel="next">Next</a></li>`;
                } else {
                    pagination += `<li class="disabled page-item"><span class="page-link">Next</span></li>`;
                }
                pagination += `<li class="page-item"><a class="page-link" href="${ response.last_page_url}" rel="prev">End</a></li>
                         </ul>`;
            }
            return pagination;
        }
    </script>
</body>

</html>