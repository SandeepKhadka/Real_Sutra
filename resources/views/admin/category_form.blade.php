@extends('layouts.admin')

@section('title', isset($category_list) ? 'Update Category | Admin Dashboard | Sutra Accessories' : 'Add Category | Admin Dashboard | Sutra Accessories')


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

@section('scripts')
    <script>
        if(window.$('#is_parent').is(':checked')){
            window.$('#parent_div').hide();
        }
        window.$('#is_parent').change(function (){
            window.$('#parent_div').slideToggle();
        })
    </script>
@endsection

@section('main-content')
    <div class="page-content fade-in-up">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-container">
                    <h2 class="mb-4">{{ isset($category_list) ? 'Update Category' : 'Add Category' }}</h2>
                    <form class="form" method="POST" action="{{ isset($category_list) ? route('category.update', $category_list->id) : route('category.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if (isset($category_list))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ isset($category_list) ? $category_list->title : old('title') }}" required placeholder="Enter category title">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="summary">Summary:</label>
                            <textarea name="summary" id="summary" class="form-control" placeholder="Enter category summary" rows="5">{{ isset($category_list) ? $category_list->summary : old('summary') }}</textarea>
                            @error('summary')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="is_parent">Is parent:</label>
                            <input type="checkbox" name="is_parent" id="is_parent" value="1" {{ isset($category_list) && $category_list->is_parent ? 'checked' : '' }}> Yes
                            @error('is_parent')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group" id="parent_div" style="{{ isset($category_list) && $category_list->is_parent ? 'display:none;' : '' }}">
                            <label for="parent_id">Parent Category:</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="">-- Select any one --</option>
                                @foreach($parent_id as $id => $name)
                                    <option value="{{ $id }}" {{ isset($category_list) && $category_list->parent_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="active" {{ isset($category_list) && $category_list->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ isset($category_list) && $category_list->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if (isset($category_list) && $category_list->image)
                                <img src="{{ asset('uploads/category/Thumb-' . $category_list->image) }}" alt="Category Image" class="img-preview">
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
