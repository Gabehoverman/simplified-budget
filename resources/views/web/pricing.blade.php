@extends('web.layout')

@section('content')

<section class="bg-primary-3 text-light header-inner pb-5 pt-5 hero">
    <div class="container py-0 layer-2 mt-5 mb-5 pb-5">
        <div class="row my-4 my-md-12 aos-init aos-animate text-center pb-5" data-aos="fade-up">
            <div class="col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                <h1 class="display-4">Straightforward Pricing</h1>
                <p class="lead mb-0">
                    Power features to help you understand your spending, tracking where your money goes, and improve
                    your financial health.
                </p>
            </div>
        </div>
    </div>
</section>

@include('web.partials.pricing-table', ['hideHeader' => true])
{{--
<section style="margin-top: -225px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <div class="card card-body align-items-center ">
                    <div class="pt-md-2">
                        <h4>Free</h4>
                    </div>
                    <div class="d-flex align-items-start pb-md-2">
                        <span class="h3">$</span>
                        <span class="display-4 mb-0">0</span>
                    </div>
                    <span class="text-small text-muted">per month</span>
                    <ul class="text-center list-unstyled my-2 my-md-4">
                        <li class="py-1">
                            <span>10k Visitors/mo</span>
                        </li>
                        <li class="py-1">
                            <span>10 Funnels, 50 Pages</span>
                        </li>
                        <li class="py-1">
                            <span>Unlimited Transactions</span>
                        </li>
                        <li class="py-1">
                            <span>Analytics</span>
                        </li>
                        <li class="py-1">
                            <span>Integrations</span>
                        </li>
                        <li class="py-1">
                            <span class="text-muted text-strikethrough">Audience Data</span>
                        </li>
                        <li class="py-1">
                            <span class="text-muted text-strikethrough">Premium Templates</span>
                        </li>
                        <li class="py-1">
                            <span class="text-muted text-strikethrough">White Labelling</span>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-outline-primary btn-block">
                        Start for Free
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                <div class="card card-body align-items-center">
                    <span class="badge badge-top badge-dark">Most Popular</span>
                    <div class="pt-md-2">
                        <h4>Monthly</h4>
                    </div>
                    <div class="d-flex align-items-start pb-md-2">
                        <span class="h3">$</span>
                        <span class="display-4 mb-0">9</span>
                    </div>
                    <span class="text-small text-muted">per month</span>
                    <ul class="text-center list-unstyled my-2 my-md-4">
                        <li class="py-1">
                            <span>10k Visitors/mo</span>
                        </li>
                        <li class="py-1">
                            <span>10 Funnels, 50 Pages</span>
                        </li>
                        <li class="py-1">
                            <span>Unlimited Transactions</span>
                        </li>
                        <li class="py-1">
                            <span>Analytics</span>
                        </li>
                        <li class="py-1">
                            <span>Integrations</span>
                        </li>
                        <li class="py-1">
                            <span>Audience Data</span>
                        </li>
                        <li class="py-1">
                            <span>Premium Templates</span>
                        </li>
                        <li class="py-1">
                            <span class="text-muted text-strikethrough">White Labelling</span>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-block">
                        Start for Free
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                <div class="card card-body align-items-center">
                    <div class="pt-md-2">
                        <h4>Annual</h4>
                    </div>
                    <div class="d-flex align-items-start pb-md-2">
                        <span class="h3">$</span>
                        <span class="display-4 mb-0">50</span>
                    </div>
                    <span class="text-small text-muted">per year</span>
                    <ul class="text-center list-unstyled my-2 my-md-4">
                        <li class="py-1">
                            <span>10k Visitors/mo</span>
                        </li>
                        <li class="py-1">
                            <span>10 Funnels, 50 Pages</span>
                        </li>
                        <li class="py-1">
                            <span>Unlimited Transactions</span>
                        </li>
                        <li class="py-1">
                            <span>Analytics</span>
                        </li>
                        <li class="py-1">
                            <span>Integrations</span>
                        </li>
                        <li class="py-1">
                            <span>Audience Data</span>
                        </li>
                        <li class="py-1">
                            <span>Premium Templates</span>
                        </li>
                        <li class="py-1">
                            <span class="text-muted text-strikethrough">White Labelling</span>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-outline-primary btn-block">
                        Start for Free
                    </a>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<section class="mb-5 mt-0 pt-3">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-5">
                <h2>Frequently Asked Questions</h2>
                <p class="lead mb-0">
                    Power features to help you understand your spending, tracking where your money goes, and improve
                    your financial health.
                </p>
                <a href=" {{ route('register') }}"
                    class="btn btn-lg lg btn-primary mt-3">
                    Get Started
                </a>
            </div>
            <div class="col-lg-7">
                @include('web.partials.accordion-item', array('index' => 1, 'title' => 'Do you offer a free plan?', 'body' => 'Yes, our manual plan is free forever, and allows you to track your transactions, accounts, and budgets by hand.'))

                @include('web.partials.accordion-item', array('index' => 2, 'title' => 'Do you offer a free plan?', 'body' => 'Yes, our manual plan is free forever, and allows you to track your transactions, accounts, and budgets by hand.'))

                @include('web.partials.accordion-item', array('index' => 3, 'title' => 'Do you offer a free plan?', 'body' => 'Yes, our manual plan is free forever, and allows you to track your transactions, accounts, and budgets by hand.'))

                @include('web.partials.accordion-item', array('index' => 4, 'title' => 'Do you offer a free plan?', 'body' => 'Yes, our manual plan is free forever, and allows you to track your transactions, accounts, and budgets by hand.'))

                @include('web.partials.accordion-item', array('index' => 5, 'title' => 'Do you offer a free plan?', 'body' => 'Yes, our manual plan is free forever, and allows you to track your transactions, accounts, and budgets by hand.'))

                @include('web.partials.accordion-item', array('index' => 6, 'title' => 'Do you offer a free plan?', 'body' => 'Yes, our manual plan is free forever, and allows you to track your transactions, accounts, and budgets by hand.'))

            </div>
        </div>
    </div>
</section>

@endsection
