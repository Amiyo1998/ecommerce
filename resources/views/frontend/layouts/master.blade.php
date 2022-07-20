<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield("title")</title>
    @include('frontend.layouts.partials._styles')
    @yield('styles')
</head>
<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
   <!-- Header Section Begin -->
    @include('frontend.layouts.partials._header')
    <!-- Header Section End -->
    <!-- Hero Section Begin -->
    @yield('content')
    <!-- Blog Section End -->

    <!-- Footer Section Begin -->
    @include('frontend.layouts.partials._footer')
    <!-- Footer Section End -->
    <!-- Js Plugins -->
   @include('frontend.layouts.partials._scripts')
   @yield('scripts')
</body>
</html>
