@include('layouts.partials.header')

<body>
    <div id="app">
    {{-- <div> --}}
        @include('layouts.partials.sidebar')
        @include('layouts.partials.topbar')
        <main class="main-content">
            @yield('content')
        </main>
    </div>


    @include('layouts.partials.footer')

    <script>
            $(function(){
                var current = location.pathname;
                $('#sidebarCollapse .nav-link').each(function(){
                    var $this = $(this);
                    // if the current path is like this link, make it active
                    if($this.attr('href').indexOf(current) !== -1){
                        $this.addClass('active');
                    }
                })
            })
    </script>
</body>
</html>
