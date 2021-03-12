<!DOCTYPE html>
<html lang="en">

@include('web.layout.header')

<body data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0" class="loaded">

    @include('web.layout.nav')

    @yield('content')

    @include('web.layout.footer')

</body>
