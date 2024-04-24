@extends('layouts.admin')

@section('form_style')
    <link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
    <style>
        .row-color-1 {
            background-color: #fdaeae;
        }

        .row-color-2 {
            background-color: #9cd0f6;
        }

        .row-color-3 {
            background-color: #c7f6d0;
        }

        .row-color-4 {
            background-color: #f6e0c7;
        }
    </style>
@endsection
@section('scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script>
        $('.table').DataTable();
    </script>
@endsection
@section('title', 'Product List | Admin Dashboard | Sutra Accessories')

@section('main-content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-5">
                                    <a href="{{ route('product.create') }}" class="btn btn-success">
                                        Create Product
                                    </a>
                                </div>

                                <div class="col-lg-4">

                                    <div class="ibox-title">All Products</div>
                                </div>

                                <div class="col-lg-2">

                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-hover">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Thumbnail</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th style="width: 50px">Edit</th>
                                    <th style="width: 50px">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($product_list))
                                    @foreach ($product_list as $key => $product_data)
                                        @php
                                            $row_color_class = 'row-color-' . (($key % 4) + 1);
                                        @endphp
                                        <tr class="{{ $row_color_class }}">
                                            <td>
                                                {{ $product_data->title }}
                                            </td>
                                            <td>
                                                {{ \App\Models\Category::where('id', $product_data->cat_id)->value('title') }}
                                            </td>
                                            <td>
                                                {{ \App\Models\Category::where('id', $product_data->sub_cat_id)->value('title') }}
                                            </td>
                                            <td>
                                                <img src="{{ asset('uploads/product/Thumb-' . $product_data->image) }}"
                                                    alt="" class="img img-fluid" style="max-width: 4rem;">
                                            </td>
                                            <td>
                                                Rs {{ $product_data->price }}
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $product_data->status == 'active' ? 'success' : 'danger' }}">
                                                    {{ ucfirst($product_data->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                {!! Form::open([
                                                    'url' => route('product.edit', $product_data->id),
                                                    'class' => 'form form-container',
                                                    'files' => true,
                                                    'method' => 'get',
                                                ]) !!}
                                                <button type="submit" class="btn btn-success">Edit</button>
                                                {!! Form::close() !!}
                                            </td>
                                            <td>
                                                {{ Form::open(['url' => route('product.destroy', $product_data->id), 'class' => 'form form-container', 'files' => true, 'method' => 'delete']) }}
                                                @method('delete')
                                                <button class="btn btn-danger"
                                                    onclick="return confirm('Do you want to delete this product');">
                                                    Delete
                                                </button>
                                                {{ Form::close() }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
