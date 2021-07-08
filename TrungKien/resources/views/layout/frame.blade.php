<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous" <link href="<?= asset('css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= asset('css/datepicker3.css') ?>" rel="stylesheet">
    <link href="<?= asset('css/styles.css') ?>" rel="stylesheet">
    <script type="<?= asset('text/javascript') ?>" src="ckeditor/ckeditor.js"></script>
    <script src="<?= asset('js/lumino.glyphs.js') ?>"></script>
    <script src="<?= asset('js/jquery-1.11.1.min.js') ?>"></script>
</head>

<body>
    <button class="toggle_btn">
        <i class="fas fa-bars"></i>
    </button>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?= route('home')?>">NCC Company</a>
                <ul class="user-menu">

                    <li class="dropdown pull-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user">
                                <use xlink:href="#stroked-male-user"></use>
                            </svg> User <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#"><svg class="glyph stroked cancel">
                                        <use xlink:href="#stroked-cancel"></use>
                                    </svg> Logout</a></li>
                        </ul>
                    </li>
                </ul>

            </div>

        </div><!-- /.container-fluid -->
    </nav>

    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <ul class="nav menu">
            <li class="<?php if ($title == 'home') echo 'active'; ?>"><a href="<?= route('home') ?> ">
                    <i class="fas fa-home"></i> Trang chủ</a>
            </li>
            <li class="<?php if ($title == 'product') echo 'active'; ?>"><a href="<?= route('product.index') ?>">
                    <i class="fab fa-product-hunt"></i>Sản phẩm</a></li>
            <li class="<?php if ($title == 'category') echo 'active'; ?>"><a href="<?= route('category.index') ?>">
                    <i class="fab fa-cuttlefish"></i> Danh mục sản phẩm</a></li>
            <li class="<?php if ($title == 'producttype') echo 'active'; ?>"><a href="<?= route('producttype.index') ?>">
                    <i class="fas fa-box-open"></i>Loại sản phẩm</a></li>
        </ul>

    </div>
    <!--/.sidebar-->
    @yield('index')
    @yield('product')
    @yield('editproduct')
    @yield('addproduct')
    @yield('detailproduct')
    @yield('category')
    @yield('editcategory')
    @yield('producttype')
    @yield('editproducttype')
    <script src="<?= asset('js/myscript.js') ?>"></script>
    <script src="<?= asset('js/chart.min.js') ?>"></script>
    <script src="<?= asset('js/chart-data.js') ?>"></script>
    <script src="<?= asset('js/easypiechart.js') ?>"></script>
    <script src="<?= asset('js/easypiechart-data.js') ?>"></script>
    <script src="<?= asset('js/bootstrap-datepicker.js') ?>"></script>
    <script>
        $('#calendar').datepicker({});
        
        ! function($) {
            $(document).on("click", "ul.nav li.parent > a > span.icon", function() {
                $(this).find('em:first').toggleClass("glyphicon-minus");
            });
            $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
        }(window.jQuery);

        $(window).on('resize', function() {
            if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
        })
        $(window).on('resize', function() {
            if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
        })

        // ajax for select all category from one ProductType
        if (typeof($('#addProductType')) !== 'undefined') {
            $('#addProductType').on('change', function() {
                $.ajax({
                    type: 'POST',
                    url: "<?= route('ajax') ?>",
                    data: {
                        category: $('#addProductType').val(),
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        var categories = "";
                        for (const element of JSON.parse(response)) {
                            categories += `"<option value="${element.product_category_id }">${element.product_category_name}</option>"`
                        }
                        $("#addCategory").html(categories);
                        categories = "";
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        //xử lý lỗi tại đây
                    }
                })
            });   
        }
    </script>
</body>

</html>