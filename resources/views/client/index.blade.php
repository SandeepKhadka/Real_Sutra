@extends('layouts.client')

@section('title', 'Sutra Accessories')
@section('style')
    <style>
        .box {
            height: 300px;
            /* Set a fixed height for the product boxes */
            margin-bottom: 20px;
            /* Add margin between product boxes */
            position: relative;
            overflow: hidden;
        }

        .box img {
            max-height: 100%;
            width: auto;
            display: block;
            margin: 0 auto;
        }

        .detail-box {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.8);
            /* Semi-transparent white background */
            padding: 10px;
            box-sizing: border-box;
        }

        .detail-box h6 {
            margin: 0;
        }

        .shop_section {
            background-color: #f8f9fa;
            padding: 50px 0;
        }

        .heading_container h2 {
            color: #333;
            font-size: 36px;
            margin-bottom: 30px;
        }

        .latest_products_carousel .box {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .latest_products_carousel .box a {
            display: block;
            color: inherit;
            text-decoration: none;
            transition: transform 0.3s;
        }

        .latest_products_carousel .box:hover a {
            transform: translateY(-5px);
        }

        .latest_products_carousel .box img {
            width: 100%;
            height: auto;
            border-bottom: 1px solid #ddd;
        }

        .latest_products_carousel .detail-box {
            padding: 20px;
        }

        .latest_products_carousel .detail-box h6 {
            margin: 0;
            color: #333;
        }

        .latest_products_carousel .detail-box h6 span {
            font-weight: bold;
        }

        .latest_products_carousel .new {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: red;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .latest_products_carousel .btn-box {
            text-align: center;
            margin-top: 40px;
        }

        .latest_products_carousel .btn-box a {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 30px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .latest_products_carousel .btn-box a:hover {
            background-color: #0056b3;
        }
    </style>
@endsection

@section('main-content')
    <!-- slider section -->

    <section class="slider_section">
        <div class="slider_container">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="5000">
                <div class="carousel-inner">
                    @if (isset($banner_list) && count($banner_list) > 0)
                        @foreach ($banner_list as $key => $banner_data)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img class="d-block w-100" src="{{ asset('uploads/banner/Thumb-' . $banner_data->image) }}"
                                    alt="{{ $banner_data->title }}">
                            </div>
                        @endforeach
                    @endif
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>



    <!-- end slider section -->

    <!-- shop section -->

    <section class="shop_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h3>Latest Products</h3>
            </div>
            <div d="latestProductCarousel" class="carousel slide latest_products_carousel" data-ride="carousel">
                <div class="row carousel-inner" id="latestCarouselInner">
                    <!-- Carousel items will be dynamically added here -->
                </div>
            </div>
            {{-- <a class="carousel-control-prev" href="#latestProductCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#latestProductCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a> --}}
        </div>
        <script>
            // Sample product data
            var latestProducts = [
                @foreach ($latest_product_list as $product)
                    {
                        id: "{{ $product->id }}",
                        name: "{{ $product->title }}",
                        price: "{{ $product->price }}",
                        image: "{{ asset('uploads/product/' . $product->image) }}"
                    },
                @endforeach
            ];

            var latestCarouselInner = document.getElementById("latestCarouselInner");

            // Display products in groups of 4 per carousel item
            for (var i = 0; i < latestProducts.length; i += 4) {
                var carouselItem = document.createElement("div");
                carouselItem.classList.add("carousel-item");

                if (i === 0) {
                    carouselItem.classList.add("active"); // Add "active" to the first carousel item
                }

                var row = document.createElement("div");
                row.classList.add("row");

                // Display up to 4 products in each carousel item
                for (var j = i; j < i + 4 && j < latestProducts.length; j++) {
                    var product = latestProducts[j];

                    var productColumn = document.createElement("div");
                    productColumn.classList.add("col-sm-6", "col-md-4", "col-lg-3");

                    var productBox = document.createElement("div");
                    productBox.classList.add("box");

                    // Construct the URL with the correct format
                    var productUrl = "{{ route('front.single_product', ['id' => '']) }}/" + product.id + "/" + product.name;

                    productBox.innerHTML = `
                            <a href="${productUrl}">
                                <div>
                                    <img src="${product.image}" alt="${product.name}" style="max-width: 100%; height: auto;">
                                </div>
                                <div class="detail-box">
                                    <h6>${product.name}</h6>
                                    <h6>Rs <span>${product.price}</span></h6>
                                </div>
                                <div class="new" style='background: #23ef0c; color: white'>
                                    <span>New</span>
                                </div>
                            </a>
                        `;
                    productColumn.appendChild(productBox);
                    row.appendChild(productColumn);
                }

                carouselItem.appendChild(row);
                latestCarouselInner.appendChild(carouselItem);
            }
        </script>



        <div class="btn-box">
            <a href="{{ route('front.latestProducts') }}">
                View More
            </a>
        </div>
        </div>
    </section>

    <section class="slider_section">
        <div class="slider_container">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="5000">
                <div class="carousel-inner">
                    @if (isset($banner_list) && count($banner_list) > 0)
                        @foreach ($banner_list as $key => $banner_data)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img class="d-block w-100" src="{{ asset('uploads/banner/Thumb-' . $banner_data->image) }}"
                                    alt="{{ $banner_data->title }}">
                            </div>
                        @endforeach
                    @endif
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>

    <section class="shop_section" style="background: rgb(226, 108, 108); margin: 20px">
        <div class="" style="margin-left: 50px; margin-top: 20px;">
            <div class="heading_container" >
                <h3 style="color: white">SUTRA MALL</h3>
            </div>
            <div class="row" id="productRows" style="text-decoration: none; padding: 10px">
                <!-- Product items will be dynamically added here -->
            </div>
            <div class="btn-box">
                <a href="{{ route('front.justForYou') }}">View More</a>
            </div>
        </div>

        <script>
            var for_you_product = [
                @foreach ($for_you_product_list as $product)
                    {
                        name: "{{ $product->title }}",
                        price: "{{ $product->price }}",
                        id: "{{ $product->id }}", // Assuming you have a product ID
                        slug: "{{ $product->slug }}", // Assuming you have a product slug
                        image: "{{ asset('uploads/product/' . $product->image) }}"
                    },
                @endforeach
            ];

            var productRows = document.getElementById("productRows");

            // Display products in rows
            for (var i = 0; i < for_you_product.length; i += 6) { // Change the increment to 5 for 5 products in each row
                var row = document.createElement("div");
                row.classList.add("row");

                // Display up to 5 products in each row
                for (var j = i; j < i + 6 && j < for_you_product.length; j++) { // Change the limit to i + 5
                    var product = for_you_product[j];

                    var productColumn = document.createElement("div");
                    productColumn.classList.add("col-sm-6", "col-md-4", "col-lg-2"); // Adjust the column width as needed

                    var productBox = document.createElement("div");
                    productBox.classList.add("box", "redBox");

                    // Construct the URL with the correct format
                    var productUrl = "{{ route('front.single_product', ['id' => '', 'slug' => '']) }}/" + product.id + "/" +
                        product.slug;

                    productBox.innerHTML = `
                        <a href="${productUrl}">
                            <div>
                                <img src="${product.image}" alt="${product.name}" style="max-width: 100%; height:">
                            </div>
                            <div class="detail-box" style='color: black'>
                                <h6>${product.name}</h6>
                                <h6>Rs <span>${product.price}</span></h6>
                            </div>
                        </a>
                    `;

                    productColumn.appendChild(productBox);
                    row.appendChild(productColumn);
                }

                productRows.appendChild(row);
            }
        </script>
    </section>


    <!-- end shop section -->

@endsection
