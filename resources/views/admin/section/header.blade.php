<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>@yield('title')</title>
    @yield('form_style')
    {{--    <link rel="stylesheet" data-type="keditor-style" href=" @vite('resources/css/admin.css')"> --}}
    {{--    @vite('resources/css/admin.css') --}}
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>

<body class="fixed-navbar">
    @if (Auth::check())
        <a href="http://127.0.0.1:8000/chatify/1" id="chat-btn" target="new">
            💬 Chats
            <span class="badge badge-pill badge-danger">1</span>
            {{-- @if ($unseenCount > 0)
            @endif --}}
        </a>
    @else
        <a href="http://127.0.0.1:8000/login" id="chat-btn" target="new">
            <i class="fas fa-comments"></i> Chats
        </a>
    @endif
