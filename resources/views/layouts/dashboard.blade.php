@include('layouts.partials.header')

<body>
    <div id="app">
        @include('layouts.partials.sidebar')
        @include('layouts.partials.topbar')
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    @include('layouts.partials.footer')
</body>
</html>
