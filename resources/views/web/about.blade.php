@extends('web.layout')

@section('content')

<section class="bg-primary-3 text-light header-inner pb-5 pt-5 hero">
    <div class="container py-0 layer-2 mt-5 mb-5">
        <div class="row my-4 my-md-12 aos-init aos-animate text-center" data-aos="fade-up">
            <div class="col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                <h1 class="display-4">About Us</h1>
                <p class="lead mb-0">
                    Power features to help you understand your spending, tracking where your money goes, and improve your financial health.
                </p>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container" data-aos="fade-up">
      <div class="row align-items-center justify-content-around">
        <div class="col-md-6 col-xl-6">
          <div class="row justify-content-">
            <div class="col-xl-10 col-lg-10">
              <div class="my-3">
                <span class="h1">Better Financial Health With Our Help.</span>
              </div>
              <p class="lead">Monthly breakdown reports allow you to see exactly what you’re spending and where you’re spending it. We offer insights on how to better improve your financial health no matter what your goals are. </p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-6 mb-4 mb-md-0">
            <img src="https://images.unsplash.com/photo-1542744173-05336fcc7ad4?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1982&q=80" alt="Image" class="rounded shadow-3d">
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

@include('web.partials.testimonials-section', ['bglight' => true])

@endsection
