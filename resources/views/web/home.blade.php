
@extends('web.layout')

@section('content')
    <section class="pb-10 pt-10">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 col-xl-5 px-md-6 px-lg-0">
                    <h1 class="display-4">A Better Way To Manage Money.</h1>
                    <p class="lead">
                        Take control of your finances with our effortless transaction reporting, powerful reporting tools, and much more.
                    </p>
                    <a href="/register"
                        class="btn btn-primary btn-lg mt-3">Get Started</a>
                </div>
                <div class="col-lg-6">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 col-8 mt-4 mt-lg-0">
                            <img src="{{ asset('/img/home-budgets-oval.jpg') }}" alt="Image" data-aos="fade-left"
                                class="aos-init aos-animate hero-stretch">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-5 pb-1" style="background:#fafafa">
        <div class="container mb-5">
            <div class="row text-center mb-5">
                <div class="col">
                    <small class="text-uppercase">Featured Institutions</small>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <ul class="d-flex flex-wrap justify-content-center list-unstyled row">
                        <li class="col-md-6 col-lg-3 aos-init aos-animate text-center" data-aos="fade-up" data-aos-delay="100">
                            <img src="{{ asset('/img/logos/Wells Fargo Logo Transparent.png') }}" width="250">
                        </li>
                        <li class="col-md-6 col-lg-3 aos-init aos-animate text-center" data-aos="fade-up" data-aos-delay="200">
                            <img src="{{ asset('/img/logos/Chase Bank Logo Transparent.png') }}" width="250">
                        </li>
                        <li class="col-md-6 col-lg-3 aos-init aos-animate text-center" data-aos="fade-up" data-aos-delay="300">
                            <img src="{{ asset('/img/logos/Bank of America Logo Transparent.png') }}" width="250">
                        </li>
                        <li class="col-md-6 col-lg-3 aos-init aos-animate text-center" data-aos="fade-up" data-aos-delay="400">
                            <img src="{{ asset('/img/logos/American Express Logo Transparent.png') }}" width="250">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-0">
        <div class="container">
            <div class="row justify-content-center text-center mb-6">
                <div class="col-xl-8 col-lg-9">
                    <h2 class="display-4 mx-xl-6">Our Features.</h2>
                    <p class="lead">
                        Power features to help you understand your spending, tracking where your money goes, and improve your financial health.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
          <div class="row align-items-center justify-content-around">
            <div class="col-md-6 col-lg-5 mb-4 mb-md-0 aos-init aos-animate" data-aos="fade-right">
              <img src="{{ asset('img/home-feature-1.png') }}" alt="Image" class="rounded shadow stretch-image pull-left">
            </div>
            <div class="col-lg-5 col-md-6 aos-init aos-animate" data-aos="fade-left">
              <h3 class="h1">Effortless Transaction Reporting</h3>
              <p class="lead">Our system automatically reports all your transactions in one place, making it effortless to review your transactions, and break down your spending habits.</p>
              {{-- <a href="#" class="lead hover-arrow">Start Discovering</a> --}}
            </div>
          </div>
        </div>
      </section>
      <section class="">
        <div class="container">
          <div class="row align-items-center justify-content-around flex-row-reverse">
            <div class="col-md-6 col-lg-5 mb-4 mb-md-0 aos-init aos-animate" data-aos="fade-left">
              <img src="{{ asset('img/home-feature-2.png') }}" alt="Image" class="rounded shadow stretch-image pull-right">
            </div>
            <div class="col-lg-5 col-md-6 aos-init aos-animate" data-aos="fade-right">
                <h3 class="h1">
                    Detailed Monthly
                    Reports
                </h3>
                <p class="lead">Monthly breakdown reports allow you to see exactly what you’re spending and where you’re spending it. We offer insights on how to better improve your financial health no matter what your goals are. </p>
              {{-- <a href="#" class="lead hover-arrow">Start Discovering</a> --}}
            </div>
          </div>
        </div>
      </section>
      <section>
        <div class="container">
          <div class="row align-items-center justify-content-around">
            <div class="col-md-6 col-lg-5 mb-4 mb-md-0 aos-init aos-animate" data-aos="fade-right">
              <img src="{{ asset('/img/home-feature-3.png') }}" alt="Image" class="rounded shadow stretch-image pull-left">
            </div>
            <div class="col-lg-5 col-md-6 aos-init aos-animate" data-aos="fade-left">
                <h3 class="h1">
                    All Your Accounts<br>
                    In One Place
                </h3>
              <p class="lead">Connect and track all of your accounts, all in once place and get a detailed overview of all of your finances.</p>
              {{-- <a href="#" class="lead hover-arrow">Start Discovering</a> --}}
            </div>
          </div>
        </div>
      </section>

    @include('web.partials.testimonials-section')
    @include('web.partials.pricing-table')

@endsection
