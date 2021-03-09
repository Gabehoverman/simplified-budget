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
<section class="bg">
    <div class="container">
        <div class="row justify-content-center text-center mb-6 text-dark">
            <div class="col-xl-8 col-lg-9">
                <h2 class="display-4 mx-xl-6">Customers love it.</h2>
                <p class="lead">
                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                    laudantium, totam rem aperiam, eaque ipsa.
                </p>
            </div>
        </div>
        <div class="row" data-isotope-collection="" style="position: relative; height: 656px;">
            <div class="col-sm-6 col-lg-4" data-isotope-item=""
                style="position: absolute; left: 379.984px; top: 298px;">
                <div class="card card-body">
                    <div class="flex-grow-1 mb-3">
                        <p class="lead">
                            “This is a top quality product. No need to think twice before purchasing, you simply
                            could not go wrong”
                        </p>
                    </div>
                    <div class="avatar-author align-items-center">
                        <img src="{{ asset('Leap_files/male-4.jpg') }}" alt="Avatar" class="avatar">
                        <div class="ml-2">
                            <h6>Jonathan Wilson</h6>
                            <span>Designer</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4" data-isotope-item="" style="position: absolute; left: 0px; top: 298px;">
                <div class="card card-body">
                    <div class="flex-grow-1 mb-3">
                        <p class="lead">
                            “I was thrilled by the quality of the customer support. The team were helpful throughout
                            the entire process, I couldn’t be happier with the results – will use again!”
                        </p>
                    </div>
                    <div class="avatar-author align-items-center">
                        <img src="{{ asset('Leap_files/female-1.jpg') }}" alt="Avatar" class="avatar">
                        <div class="ml-2">
                            <h6>Annabelle Porter</h6>
                            <span>Developer</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4" data-isotope-item=""
                style="position: absolute; left: 759.968px; top: 268px;">
                <div class="card card-body">
                    <div class="flex-grow-1 mb-3">
                        <p class="lead">
                            “Finally, I’ve found a template that covers all bases for a bootstrapped startup. We
                            were able to launch in days, not months.”
                        </p>
                    </div>
                    <div class="avatar-author align-items-center">
                        <img src="{{ asset('Leap_files/female-4.jpg') }}" alt="Avatar" class="avatar">
                        <div class="ml-2">
                            <h6>Anna Souzakis</h6>
                            <span>Cusomter</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4" data-isotope-item=""
                style="position: absolute; left: 759.968px; top: 0px;">
                <div class="card card-body">
                    <div class="flex-grow-1 mb-3">
                        <p class="lead">
                            “Once again, my expectations have been surpassed – Bravo!”
                        </p>
                    </div>
                    <div class="avatar-author align-items-center">
                        <img src="{{ asset('Leap_files/male-5.jpg') }}" alt="Avatar" class="avatar">
                        <div class="ml-2">
                            <h6>Brett Thompson</h6>
                            <span>Designer</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4" data-isotope-item=""
                style="position: absolute; left: 379.984px; top: 0px;">
                <div class="card card-body">
                    <div class="flex-grow-1 mb-3">
                        <p class="lead">
                            “Simply the best. Better than all the rest. I’d recommend this product to beginners and
                            advanced users.”
                        </p>
                    </div>
                    <div class="avatar-author align-items-center">
                        <img src="{{ asset('Leap_files/male-2.jpg') }}" alt="Avatar" class="avatar">
                        <div class="ml-2">
                            <h6>Ravi</h6>
                            <span>Designer</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4" data-isotope-item="" style="position: absolute; left: 0px; top: 0px;">
                <div class="card card-body">
                    <div class="flex-grow-1 mb-3">
                        <p class="lead">
                            “What usually takes at least 2 or 3 weeks was reduced to 4 days. That in itself is
                            invaluable.”
                        </p>
                    </div>
                    <div class="avatar-author align-items-center">
                        <img src="{{ asset('Leap_files/female-2.jpg') }}" alt="Avatar" class="avatar">
                        <div class="ml-2">
                            <h6>Abigail Roberts</h6>
                            <span>Marketer</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
