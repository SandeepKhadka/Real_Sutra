@extends('layouts.admin')

@section('title', isset($product_list) ? 'Update Product | Admin Dashboard | Sutra Accessories' : 'Add Product | Admin Dashboard | Sutra Accessories')

@section('form_style')
    <style>
        /* Add your custom form styles here */
        .form-container {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        .form-control {
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus {
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            border-color: #80bdff;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            color: white;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .img-preview {
            max-width: 200px;
            margin-top: 10px;
        }
    </style>
@endsection

@section('main-content')
    <div class="page-content fade-in-up">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-container">
                    <h2 class="mb-4">{{ isset($product_list) ? 'Update Product' : 'Add Product' }}</h2>
                    <form class="form" method="POST" action="{{ isset($product_list) ? route('product.update', $product_list->id) : route('product.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if (isset($product_list))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ isset($product_list) ? $product_list->title : old('title') }}" required placeholder="Enter product title">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="summary">Summary:</label>
                            <textarea name="summary" id="summary" class="form-control" placeholder="Enter product summary" rows="5">{{ isset($product_list) ? $product_list->summary : old('summary') }}</textarea>
                            @error('summary')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" class="form-control" placeholder="Enter product description" rows="5">{{ isset($product_list) ? $product_list->description : old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cat_id">Category:</label>
                            <select name="cat_id" id="cat_id" class="form-control" required>
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ isset($product_list) && $product_list->cat_id == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('cat_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sub_cat_id">Sub Category:</label>
                            <select name="sub_cat_id" id="sub_cat_id" class="form-control">
                                <option value="">-- Select Sub Category --</option>
                                @foreach($sub_categories as $sub_category)
                                    <option value="{{ $sub_category->id }}" {{ isset($product_list) && $product_list->sub_cat_id == $sub_category->id ? 'selected' : '' }}>{{ $sub_category->title }}</option>
                                @endforeach
                            </select>
                            @error('sub_cat_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock:</label>
                            <input type="number" name="stock" id="stock" class="form-control" value="{{ isset($product_list) ? $product_list->stock : old('stock') }}" required placeholder="Enter product stock">
                            @error('stock')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" name="price" id="price" class="form-control" value="{{ isset($product_list) ? $product_list->price : old('price') }}" required placeholder="Enter product price">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="conditions">Condition:</label>
                            <select name="conditions" id="conditions" class="form-control" required>
                                <option value="">-- Select Condition --</option>
                                <option value="hot" {{ isset($product_list) && $product_list->conditions == 'hot' ? 'selected' : '' }}>Hot</option>
                                <option value="new" {{ isset($product_list) && $product_list->conditions == 'new' ? 'selected' : '' }}>New</option>
                                <option value="sale" {{ isset($product_list) && $product_list->conditions == 'sale' ? 'selected' : '' }}>Sale</option>
                                <option value="for_you" {{ isset($product_list) && $product_list->conditions == 'for_you' ? 'selected' : '' }}>For You</option>
                            </select>
                            @error('conditions')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="active" {{ isset($product_list) && $product_list->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ isset($product_list) && $product_list->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*" {{ isset($product_list) ? '' : 'required' }}>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if (isset($product_list) && $product_list->image)
                                <img src="{{ asset('uploads/product/Thumb-' . $product_list->image) }}" alt="Product Image" class="img-preview">
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="reset" class="btn btn-danger"><i class="fa fa-trash"></i> Reset</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
