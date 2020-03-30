<html lang="{{ app()->getLocale() }}">

    @include('partials.panel.head')

<body class="bg-gray-100 h-screen antialiased leading-none">
    @include('partials.panel.header')

    <h3 class="text-center text-3xl mb-8">
        @yield('title')
    </h3>

    @yield('content')

    @include('partials.panel.footer')
    @include('partials.panel.scripts')
    @include('sweetalert::alert')
</body>
</html>
