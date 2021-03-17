@extends('web.layout')

@section('content')

<section class="bg-primary-3 text-light header-inner pb-5 pt-5 hero">
    <div class="container py-0 layer-2 mt-5 mb-5">
        <div class="row my-4 my-md-12 aos-init aos-animate text-center" data-aos="fade-up">
            <div class="col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                <h1 class="display-4">Powerful Features</h1>
                <p class="lead mb-0">
                    Powerful features to help you understand your spending, tracking where your money goes, and improve
                    your financial health.
                </p>
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
                    Power features to help you understand your spending, tracking where your money goes, and improve
                    your financial health.
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
                <p class="lead">Our system automatically reports all your transactions in one place, making it
                    effortless to review your transactions, and break down your spending habits.</p>
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
                <p class="lead">Monthly breakdown reports allow you to see exactly what you’re spending and where you’re
                    spending it. We offer insights on how to better improve your financial health no matter what your
                    goals are. </p>
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
                <p class="lead">Connect and track all of your accounts, all in once place and get a detailed overview of
                    all of your finances.</p>
                {{-- <a href="#" class="lead hover-arrow">Start Discovering</a> --}}
            </div>
        </div>
    </div>
</section>

<section class="bg-primary-1 text-dark pb-5" style="background: #fafafa; z-index: 0">
    <div class="container pb-md-6">
        <div class="row mb-4">
            <div class="col">
                <h2 class="h1">Premium Features</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 d-flex mb-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1" class="injected-svg icon"
                    data-src="assets/img/icons/theme/shopping/wallet.svg">
                    <title>Icon For Wallet</title>
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect opacity="0" x="0" y="0" width="24" height="24"></rect>
                        <circle fill="#000000" opacity="0.3" cx="20.5" cy="12.5" r="1.5"></circle>
                        <rect fill="#000000" opacity="0.3"
                            transform="translate(12.000000, 6.500000) rotate(-15.000000) translate(-12.000000, -6.500000) "
                            x="3" y="3" width="18" height="7" rx="1"></rect>
                        <path
                            d="M22,9.33681558 C21.5453723,9.12084552 21.0367986,9 20.5,9 C18.5670034,9 17,10.5670034 17,12.5 C17,14.4329966 18.5670034,16 20.5,16 C21.0367986,16 21.5453723,15.8791545 22,15.6631844 L22,18 C22,19.1045695 21.1045695,20 20,20 L4,20 C2.8954305,20 2,19.1045695 2,18 L2,6 C2,4.8954305 2.8954305,4 4,4 L20,4 C21.1045695,4 22,4.8954305 22,6 L22,9.33681558 Z"
                            fill="#000000"></path>
                    </g>
                </svg>
                <div class="ml-3">
                    <h5>Transaction Recording</h5>
                    <p>
                        Monitor all of your transactions in one place to see a clear view of where your money goes.
                    </p>
                </div>
            </div>
            <div class="col-md-4 d-flex mb-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1" class="injected-svg icon"
                    data-src="assets/img/icons/theme/general/settings-1.svg">
                    <title>Icon For Settings-1</title>
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect opacity="0" x="0" y="0" width="24" height="24"></rect>
                        <path
                            d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z"
                            fill="#000000"></path>
                        <path
                            d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z"
                            fill="#000000" opacity="0.3"></path>
                    </g>
                </svg>
                <div class="ml-3">
                    <h5>Intuitive Budgets</h5>
                    <p>
                        Create monthly and annual budgets to track your spending, and progress towards yur financial goals.
                    </p>
                </div>
            </div>
            <div class="col-md-4 d-flex mb-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1" class="injected-svg icon"
                    data-src="assets/img/icons/theme/files/cloud-upload.svg">
                    <title>Icon For Cloud-upload</title>
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" opacity="0"></polygon>
                        <path
                            d="M5.74714567,13.0425758 C4.09410362,11.9740356 3,10.1147886 3,8 C3,4.6862915 5.6862915,2 9,2 C11.7957591,2 14.1449096,3.91215918 14.8109738,6.5 L17.25,6.5 C19.3210678,6.5 21,8.17893219 21,10.25 C21,12.3210678 19.3210678,14 17.25,14 L8.25,14 C7.28817895,14 6.41093178,13.6378962 5.74714567,13.0425758 Z"
                            fill="#000000" opacity="0.3"></path>
                        <path
                            d="M11.1288761,15.7336977 L11.1288761,17.6901712 L9.12120481,17.6901712 C8.84506244,17.6901712 8.62120481,17.9140288 8.62120481,18.1901712 L8.62120481,19.2134699 C8.62120481,19.4896123 8.84506244,19.7134699 9.12120481,19.7134699 L11.1288761,19.7134699 L11.1288761,21.6699434 C11.1288761,21.9460858 11.3527337,22.1699434 11.6288761,22.1699434 C11.7471877,22.1699434 11.8616664,22.1279896 11.951961,22.0515402 L15.4576222,19.0834174 C15.6683723,18.9049825 15.6945689,18.5894857 15.5161341,18.3787356 C15.4982803,18.3576485 15.4787093,18.3380775 15.4576222,18.3202237 L11.951961,15.3521009 C11.7412109,15.173666 11.4257142,15.1998627 11.2472793,15.4106128 C11.1708299,15.5009075 11.1288761,15.6153861 11.1288761,15.7336977 Z"
                            fill="#000000" fill-rule="nonzero"
                            transform="translate(11.959697, 18.661508) rotate(-90.000000) translate(-11.959697, -18.661508) ">
                        </path>
                    </g>
                </svg>
                <div class="ml-3">
                    <h5>Account Management</h5>
                    <p>
                        Amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                        aliqua.
                    </p>
                </div>
            </div>
            <div class="col-md-4 d-flex mb-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1" class="injected-svg icon"
                    data-src="assets/img/icons/theme/communication/group.svg">
                    <title>Icon For Group</title>
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" opacity="0"></polygon>
                        <path
                            d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                            fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                        <path
                            d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                            fill="#000000" fill-rule="nonzero"></path>
                    </g>
                </svg>
                <div class="ml-3">
                    <h5>Monthly Spending Reports</h5>
                    <p>
                        Amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                        aliqua.
                    </p>
                </div>
            </div>
            <div class="col-md-4 d-flex mb-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="500">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1" class="injected-svg icon"
                    data-src="assets/img/icons/theme/shopping/chart-line-1.svg">
                    <title>Icon For Chart-line#1</title>
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect opacity="0" x="0" y="0" width="24" height="24"></rect>
                        <path
                            d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z"
                            fill="#000000" fill-rule="nonzero"></path>
                        <path
                            d="M8.7295372,14.6839411 C8.35180695,15.0868534 7.71897114,15.1072675 7.31605887,14.7295372 C6.9131466,14.3518069 6.89273254,13.7189711 7.2704628,13.3160589 L11.0204628,9.31605887 C11.3857725,8.92639521 11.9928179,8.89260288 12.3991193,9.23931335 L15.358855,11.7649545 L19.2151172,6.88035571 C19.5573373,6.44687693 20.1861655,6.37289714 20.6196443,6.71511723 C21.0531231,7.05733733 21.1271029,7.68616551 20.7848828,8.11964429 L16.2848828,13.8196443 C15.9333973,14.2648593 15.2823707,14.3288915 14.8508807,13.9606866 L11.8268294,11.3801628 L8.7295372,14.6839411 Z"
                            fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                    </g>
                </svg>
                <div class="ml-3">
                    <h5>Futurecasting and Projections</h5>
                    <p>
                        Use our powerful futurecasting tools to see how financial decisions can affect your financial future.
                    </p>
                </div>
            </div>
            <div class="col-md-4 d-flex mb-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="600">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1" class="injected-svg icon"
                    data-src="assets/img/icons/theme/tools/pantone.svg">
                    <title>Icon For Pantone</title>
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon opacity="0" points="0 0 24 0 24 24 0 24"></polygon>
                        <path
                            d="M22,15 L22,19 C22,20.1045695 21.1045695,21 20,21 L8,21 C5.790861,21 4,19.209139 4,17 C4,14.790861 5.790861,13 8,13 L20,13 C21.1045695,13 22,13.8954305 22,15 Z M7,19 C8.1045695,19 9,18.1045695 9,17 C9,15.8954305 8.1045695,15 7,15 C5.8954305,15 5,15.8954305 5,17 C5,18.1045695 5.8954305,19 7,19 Z"
                            fill="#000000" opacity="0.3"></path>
                        <path
                            d="M15.5421357,5.69999981 L18.3705628,8.52842693 C19.1516114,9.30947552 19.1516114,10.5758055 18.3705628,11.3568541 L9.88528147,19.8421354 C8.3231843,21.4042326 5.79052439,21.4042326 4.22842722,19.8421354 C2.66633005,18.2800383 2.66633005,15.7473784 4.22842722,14.1852812 L12.7137086,5.69999981 C13.4947572,4.91895123 14.7610871,4.91895123 15.5421357,5.69999981 Z M7,19 C8.1045695,19 9,18.1045695 9,17 C9,15.8954305 8.1045695,15 7,15 C5.8954305,15 5,15.8954305 5,17 C5,18.1045695 5.8954305,19 7,19 Z"
                            fill="#000000" opacity="0.3"></path>
                        <path
                            d="M5,3 L9,3 C10.1045695,3 11,3.8954305 11,5 L11,17 C11,19.209139 9.209139,21 7,21 C4.790861,21 3,19.209139 3,17 L3,5 C3,3.8954305 3.8954305,3 5,3 Z M7,19 C8.1045695,19 9,18.1045695 9,17 C9,15.8954305 8.1045695,15 7,15 C5.8954305,15 5,15.8954305 5,17 C5,18.1045695 5.8954305,19 7,19 Z"
                            fill="#000000"></path>
                    </g>
                </svg>
                <div class="ml-3">
                    <h5>Money Saving Offers</h5>
                    <p>
                        Our team currates the best offers to help you save money, and make your money last.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
