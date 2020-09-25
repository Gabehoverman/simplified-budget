@include('layouts.partials.header')

<body style="background: url('/img/wave.png');">
    <div id="app">
        @include('layouts.partials.topbar')
        <main class="main-content">
            <onboarding-page-component
                :user="{{ Auth::User() }}"
                :institutions="{{ json_encode($institutions) }}"
                :account="{{ json_encode( $account ) }}"
            />
        </main>
    </div>

    @include('layouts.partials.footer')
</body>
</html>
