@extends('layouts.admin')

@section('title', 'Banner List | Admin Dashboard | Sutra Accessories')

@section('form_style')
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

@section('main-content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-5" >
                                    <a href="{{ route('banner.create') }}" class="btn btn-success">
                                        Create Banner
                                    </a>
                                </div>

                                <div class="col-lg-4" >

                                    <div class="ibox-title">All Banners</div>
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
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th style="width: 50px">Edit</th>
                                    <th style="width: 50px">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($banner_list))
                                    @foreach ($banner_list as $key => $banner_data)
                                        @php
                                            $row_color_class = 'row-color-' . (($key % 4) + 1);
                                        @endphp
                                        <tr class="{{ $row_color_class }}">
                                            <td>{{ $banner_data->title }}</td>
                                            <td>
                                                <img src="{{ asset('uploads/banner/Thumb-' . $banner_data->image) }}"
                                                    alt="" class="img img-fluid" style="max-width: 4rem;">
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $banner_data->status == 'active' ? 'success' : 'danger' }}">
                                                    {{ ucfirst($banner_data->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                {!! Form::open([
                                                    'url' => route('banner.edit', $banner_data->id),
                                                    'class' => 'form form-container',
                                                    'files' => true,
                                                    'method' => 'get',
                                                ]) !!}
                                                <button type="submit" class="btn btn-success">Edit</button>
                                                {!! Form::close() !!}
                                            </td>
                                            <td>
                                                {{ Form::open(['url' => route('banner.destroy', $banner_data->id), 'class' => 'form form-container', 'files' => true, 'method' => 'delete']) }}
                                                @method('delete')
                                                <button class="btn btn-danger"
                                                    onclick="return confirm('Do you want to delete this banner?')">Delete</button>
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
