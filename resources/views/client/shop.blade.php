@extends('layouts.client')

@section('title', 'Sutra Accessories')

@section('style')
    <style>
        /* CSS styles for filter options and sorting dropdown */
        .filter-sidebar {
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .filter-sidebar p {
            margin-bottom: 10px;
        }

        .filter-sidebar input[type="range"],
        .filter-sidebar select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        .sorting-dropdown {
            margin-bottom: 20px;
        }

        .sorting-dropdown select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #dddddd;
            border-radius: 5px;
            background-color: #ffffff;
            cursor: pointer;
        }

        .price-range-value {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #dddddd;
            border-radius: 10px;
            height: 100%;
            transition: transform 0.3s ease;
        }

        .product img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .product h5 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .product p {
            font-size: 14px;
            color: #888;
            margin-bottom: 5px;
        }

        .product:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('main-content')
    <section class="shop_section layout_padding">
        <div class="container">
            <div class="row">
                <!-- Category Box -->
                <div class="col-md-3">
                    <div class="category_box">
                        <!-- Category box content here -->
                    </div>
                    <!-- Filter Sidebar -->
                    <div class="filter-sidebar">
                        <h3>Filter Options</h3>
                        <!-- Price Range Filter -->
                        <p>Filter by Price:</p>
                        <input type="range" id="price-range" min="{{ $minPrice }}" max="{{ $maxPrice }}"
                            value="{{ $minPrice }}">
                        <p class="price-range-value">Price Range: $<span id="price-value">{{ $minPrice }}</span> -
                            ${{ $maxPrice }}</p>
                        <!-- Category Filter -->
                        <p>Filter by Category:</p>
                        <select id="category-filter">
                            <option value="all">All Categories</option>
                            @foreach ($parent_categories as $category)
                                <option value="{{ $category['id'] }}">{{ $category['title'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Product Display -->
                <div class="col-md-9">
                    <!-- Sorting Options Dropdown -->
                    <div class="sorting-dropdown">
                        <label for="sort-by">Sort by:</label>
                        <select id="sort-by">
                            <option value="default">Default</option>
                            <option value="price-low-high">Price: Low to High</option>
                            <option value="price-high-low" >Price: High to Low</option>
                            <!-- Add more sorting options as needed -->
                        </select>
                    </div>
                    <!-- Product Grid -->
                    <div class="row category_row">
                        <!-- Display products here -->
                        @foreach ($all_products as $product)
                            <div class="col-md-4" style="margin-bottom: 20px">
                                <a href="{{ route('front.single_product', ['id' => $product->id, 'slug' => $product->title]) }}"
                                    style="text-decoration: none; color: inherit;">
                                    <div class="product">
                                        <img src="{{ asset('uploads/product/' . $product['image']) }}" alt="Product Image">
                                        <h5>{{ $product['title'] }}</h5>
                                        <p>Price: Rs {{ $product['price'] }}</p>
                                        <!-- Add more product details as needed -->
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                    {{-- <div class="btn-box">
                    <a href="">View All Products</a>
                </div> --}}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script>
        console.log(document.getElementById('price-range'));
        document.addEventListener("DOMContentLoaded", function() {
            // Function to update price range value display
            function updatePriceValue() {
                var priceRange = document.getElementById('price-range').value;
                document.getElementById('price-value').textContent = priceRange;
            }

            // Function to construct and update URL with filter parameters
            function updateURL() {
                var priceRange = document.getElementById('price-range').value;
                var category = document.getElementById('category-filter').value;
                var sortBy = document.getElementById('sort-by').value;

                var url = '/shop';

                // Constructing URL with query parameters
                url += '?price=' + priceRange;
                url += '&category=' + category;
                url += '&sort=' + sortBy;

                // Redirecting to the updated URL
                window.location.href = url;
            }

            // Event listeners for filter options and sorting dropdown
            document.getElementById('price-range').addEventListener('input', function() {
                updatePriceValue();
                updateURL();
            });

            document.getElementById('category-filter').addEventListener('change', updateURL);
            document.getElementById('sort-by').addEventListener('change', updateURL);

            // Initial update of price range value
            updatePriceValue();
        });
    </script>
@endsection
