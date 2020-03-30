<nav class="bg-blue-900 shadow mb-8 py-6">
    <div class="container mx-auto px-6 md:px-0">
        <div class="flex items-center justify-center">
            <div class="mr-6">
                <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
            <div class="flex-1 text-right">
                <a href="/product/search" class="no-underline hover:underline text-gray-300 text-sm p-3">Produkt</a>
                @can('isAdmin')
                <a href="/admin/workers" class="no-underline hover:underline text-gray-300 text-sm p-3">Pracownicy</a>
                @endcan
                @guest
                    <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                @else
                    <a href="/" class="no-underline hover:underline text-gray-300 text-sm p-3">Zamówienia</a>
                    <span class="text-gray-300 text-sm pr-4">{{ Auth::user()->name }}</span>

                    <a href="{{ route('logout') }}"
                       class="no-underline hover:underline text-gray-300 text-sm p-3"
                       onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">{{ __('Wyloguj') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        {{ csrf_field() }}
                    </form>
                @endguest
            </div>
        </div>
    </div>
</nav>
