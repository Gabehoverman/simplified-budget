<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    {{-- <script async="" defer="" src="./leap/assets/js/api.js"></script> --}}
    {{-- <script async="" src="./Leap_files/gtm.js"></script> --}}
    {{-- <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-52115242-16');
    </script> --}}
    <!-- Google Tag Manager -->
    {{-- <script>
        (function (w, d, s, l, i) {
            w[l] = w[l] || []; w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            }); var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-KG38NH9');
    </script> --}}
    <!-- End Google Tag Manager -->

    <title>Simplified Budget - Coming Soon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A corporate Bootstrap theme by Medium Rare">
    <style>
        @keyframes hideLoader {
            0% {
                width: 100%;
                height: 100%;
            }

            100% {
                width: 0;
                height: 0;
            }
        }

        body>div.loader {
            position: fixed;
            background: white;
            width: 100%;
            height: 100%;
            z-index: 1071;
            opacity: 0;
            transition: opacity .5s ease;
            overflow: hidden;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body:not(.loaded)>div.loader {
            opacity: 1;
        }

        body:not(.loaded) {
            overflow: hidden;
        }

        body.loaded>div.loader {
            animation: hideLoader .5s linear .5s forwards;
        }

        /* Typing Animation */
        .loading-animation {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            animation: typing 1s linear infinite alternate;
            position: relative;
            left: -12px;
        }

        @keyframes typing {
            0% {
                background-color: rgba(100, 100, 100, 1);
                box-shadow: 12px 0px 0px 0px rgba(100, 100, 100, 0.2), 24px 0px 0px 0px rgba(100, 100, 100, 0.2);
            }

            25% {
                background-color: rgba(100, 100, 100, 0.4);
                box-shadow: 12px 0px 0px 0px rgba(100, 100, 100, 2), 24px 0px 0px 0px rgba(100, 100, 100, 0.2);
            }

            75% {
                background-color: rgba(100, 100, 100, 0.4);
                box-shadow: 12px 0px 0px 0px rgba(100, 100, 100, 0.2), 24px 0px 0px 0px rgba(100, 100, 100, 1);
            }
        }
    </style>
    <script type="text/javascript">
        window.addEventListener("load", function () { document.querySelector('body').classList.add('loaded'); });
    </script>
    <link href="{{ asset('/Leap_files/theme-mobile-app.min.css') }}" rel="stylesheet" type="text/css" media="all">
</head>
