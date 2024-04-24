@if ($all_products->count() > 0)
    @foreach ($all_products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box">
                <a href="{{ route('front.single_product', ['id' => $product->id, 'slug' => $product->title]) }}">
                    {{-- Adjust this according to your array structure --}}
                    <div class="img-box">
                        <img src="{{ asset('uploads/product/' . $product->image) }}" alt="" class=""
                            style="max-width: 100%; height: auto;">
                    </div>
                    <div class="detail-box"
                        style="background: #f0f0f0; padding: 15px; height: 68px; display: flex; align-items: center">
                        <h6>
                            {{ $product->title }}
                        </h6>
                        <h6>
                            <span>
                                Rs {{ $product->price }}
                            </span>
                        </h6>
                    </div>
                </a>
            </div>
        </div>
    @endforeach
@else
    <p style="text-align: center">No Products Here!</p>
@endif
