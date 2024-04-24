@extends('layouts.admin')

@section('title', isset($banner_data) ? 'Update Banner | Admin Dashboard | Sutra Accessories' : 'Add Banner | Admin Dashboard | Sutra Accessories')


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
                    <h2 class="mb-4">{{ isset($banner_data) ? 'Update Banner' : 'Add Banner' }}</h2>
                    <form class="form" method="POST" action="{{ isset($banner_data) ? route('banner.update', $banner_data->id) : route('banner.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if (isset($banner_data))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ isset($banner_data) ? $banner_data->title : old('title') }}" required placeholder="Enter banner title">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="active" {{ isset($banner_data) && $banner_data->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ isset($banner_data) && $banner_data->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" name="image" id="image" class="form-control" {{ isset($banner_data) ? '' : 'required' }} accept="image/*">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if (isset($banner_data) && $banner_data->image)
                                <img src="{{ asset('uploads/banner/Thumb-' . $banner_data->image) }}" alt="Banner Image" class="img-preview">
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="reset" class="btn btn-danger"> Reset</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
