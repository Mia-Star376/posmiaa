<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<style>
        body {
            background-color: #fdeef3;
        }
    </style>

    <div class="container-fluid px-0">

    @if(session('success'))
        <div class="alert" style="background-color: #ffe0ec; border: 1px solid #ff8fb3; color: #d94f83; border-radius: 12px; margin: 1rem;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert" style="background-color: #fbeaea; border: 1px solid #e07a7a; color: #a94442; border-radius: 12px; margin: 1rem;">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
    </div>
</body>
</html>