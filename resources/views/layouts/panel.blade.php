<html lang="{{ app()->getLocale() }}">

    @include('partials.panel.head')

<body class="bg-gray-100 h-screen antialiased leading-none">
    @include('partials.panel.header')

    @yield('content')

    @include('partials.panel.footer')
    @include('partials.panel.scripts')
</body>
</html>
