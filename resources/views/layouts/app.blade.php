<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=2.0, minimum-scale=1.0">
    <title>{{ $meta_title ?? 'M&H Construction and Design | Custom Design, Construction & Renovation' }}</title>
    @vite(['resources/js/app.js'])

    <meta name="description" content="{{ $meta_description ?? 'We design and build elegant, high-quality homes and interiors across South Carolina, Florida . From concept to completion — we bring your vision to life.' }}">

    {{-- OG --}}
    <meta property="og:title" content="{{ $og_title ?? $meta_title ?? '' }}">
    <meta property="og:description" content="{{ $og_description ?? $meta_description ?? '' }}">
    <meta property="og:image" content="{{ $og_image ?? asset('images/favicon.png') }}">
    {{-- Styles --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="style.css">

    <link rel="icon" href="{{ asset('images/logo.svg') }}" type="image/svg+xml">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">


    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-17405520602">
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'AW-17405520602');
    </script>
</head>

<body>
    <header class="header-line">
        <div class="wrapper flex-between items-center">
            <div class="logo-navigation items-center">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.svg') }}" alt="M&H Design Studio">
                </a>
                <nav class="mb-none">
                    <ul class="d-flex">
                        <li><a href="{{ route('home') . "#about" }}">About</a></li>
                        <li><a href="{{ route('home') . "#services" }}">Services</a></li>
                        <li><a href="{{ route('portfolio.index') }}">Portfolio</a></li>
                        <li><a href="{{ route('blog.index') }}">Blog</a></li>
                    </ul>
                </nav>
            </div>
            <a class="mb-none button-border" href="{{ route('contact-request.form') }}">Contact Us</a>
            <a href="#" class="burger" id="burger">
                <span></span>
                <span></span>
                <span></span>
            </a>

        </div>
    </header>
    <div class="burger-menu" id="burgerMenu">
        <ul class="d-flex">
            <li><a href="{{ route('home') . "#about" }}">About</a></li>
            <li><a href="{{ route('home') . "#services" }}">Services</a></li>
            <li><a href="{{ route('portfolio.index') }}">Portfolio</a></li>
            <li><a href="{{ route('blog.index') }}">Blog</a></li>
            <li></li>
            <li><a class="button-border" href="{{ route('contact-request.form') }}">Contact Us</a>/li>
        </ul>
    </div>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="wrapper">
            <div class="footer-top-section flex-between items-center">
                <img src="{{ asset('images/logo.svg') }}" alt="M&H Design Studio">
                <ul class="contacts">
                    <li><a href="tel:+11234567890"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M9.50246 4.25722C9.19873 3.4979 8.46332 3 7.64551 3H4.89474C3.8483 3 3 3.8481 3 4.89453C3 13.7892 10.2108 21 19.1055 21C20.1519 21 21 20.1516 21 19.1052L21.0005 16.354C21.0005 15.5361 20.5027 14.8009 19.7434 14.4971L17.1069 13.4429C16.4249 13.1701 15.6483 13.2929 15.0839 13.7632L14.4035 14.3307C13.6089 14.9929 12.4396 14.9402 11.7082 14.2088L9.79222 12.2911C9.06079 11.5596 9.00673 10.3913 9.66895 9.59668L10.2363 8.9163C10.7066 8.35195 10.8305 7.57516 10.5577 6.89309L9.50246 4.25722Z"
                                    stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>Call us: +1 (123) 4567890</a></li>
                    <li><a href="mailto:hello@mhdesign.com"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                height="20" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M5.59961 19.9203L7.12357 18.7012L7.13478 18.6926C7.45249 18.4384 7.61281 18.3101 7.79168 18.2188C7.95216 18.1368 8.12328 18.0771 8.2998 18.0408C8.49877 18 8.70603 18 9.12207 18H17.8031C18.921 18 19.4806 18 19.908 17.7822C20.2843 17.5905 20.5905 17.2842 20.7822 16.9079C21 16.4805 21 15.9215 21 14.8036V7.19691C21 6.07899 21 5.5192 20.7822 5.0918C20.5905 4.71547 20.2837 4.40973 19.9074 4.21799C19.4796 4 18.9203 4 17.8002 4H6.2002C5.08009 4 4.51962 4 4.0918 4.21799C3.71547 4.40973 3.40973 4.71547 3.21799 5.0918C3 5.51962 3 6.08009 3 7.2002V18.6712C3 19.7369 3 20.2696 3.21846 20.5433C3.40845 20.7813 3.69644 20.9198 4.00098 20.9195C4.35115 20.9191 4.76744 20.5861 5.59961 19.9203Z"
                                    stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>Write to us: hello@mhdesign.com</a></li>
                </ul>
                <ul class="sociality d-flex">
                    <li><a class="inst" href=""></a></li>
                    <li><a class="fb" href=""></a></li>
                    <li><a class="lidin" href=""></a></li>
                </ul>
            </div>
            <hr>
            <div class="flex-between footer-bottom-section">
                <p class="copy">
                    &copy; M&H Construction and Design. All rights reserved.
                </p>
                <ul class="confidentiality items-center">
                    <li><a href="{{ route('privacy.policy') }}">privacy policy</a></li>
                    <li class="stick"></li>
                    <li><a href="{{ route('terms.of.use') }}">terms of use</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const links = document.querySelectorAll('nav a[href^="index.html#"], nav a[href^="#"]');
            const sections = [];
            const stepImage = document.querySelector('.step-image');
            const steps = document.querySelectorAll('.step-card');

            const burger = document.getElementById('burger');
            const menu = document.getElementById('burgerMenu');
            const headerLine = document.querySelector('.header-line');
            const burgerLinks = document.querySelectorAll('#burgerMenu a[href*="#"]');

            let sliderInterval;

            links.forEach(link => {
                const href = link.getAttribute("href");
                const id = href.split("#")[1];
                const section = document.getElementById(id);
                if (section) sections.push({ id, element: section });

                link.addEventListener("click", function (e) {
                    const currentPage = window.location.pathname.split("/").pop();
                    if (currentPage === "" || currentPage === "index.html") {
                        e.preventDefault();
                        history.pushState(null, null, "#" + id);
                        window.scrollTo({
                            top: section.offsetTop - 80,
                            behavior: "smooth"
                        });
                    }
                });
            });

            burgerLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    const href = this.getAttribute('href');
                    const id = href.split('#')[1];
                    const target = document.getElementById(id);

                    if (target) {
                        e.preventDefault();

                        burger.classList.remove('active');
                        menu.classList.remove('active');
                        headerLine.classList.remove('active');

                        setTimeout(() => {
                            window.scrollTo({
                                top: target.offsetTop - 80,
                                behavior: "smooth"
                            });
                        }, 100);
                    }
                });
            });


            function activateScrollMode() {
                window.addEventListener("scroll", handleScroll);
                handleScroll();
            }

            function deactivateScrollMode() {
                window.removeEventListener("scroll", handleScroll);
            }

            // function startSlider() {
            //     if (!stepImage || steps.length === 0) return;
            //     let index = 0;
            //     const images = Array.from(steps).map(step => step.getAttribute('data-img-src')).filter(Boolean);

            //     stepImage.src = images[index];

            //     sliderInterval = setInterval(() => {
            //         index = (index + 1) % images.length;
            //         stepImage.src = images[index];
            //     }, 3000);
            // }

            function stopSlider() {
                clearInterval(sliderInterval);
            }

            function handleScroll() {
                if (document.querySelector('.how-we-work')) {
                    let currentId = "";
                    const scrollY = window.scrollY + 100;
    
                    // Визначаємо активний розділ для навігації
                    sections.forEach(({ id, element }) => {
                        if (element.offsetTop <= scrollY && element.offsetTop + element.offsetHeight > scrollY) {
                            currentId = id;
                        }
                    });
    
                    // Активуємо посилання у меню
                    links.forEach(link => {
                        const href = link.getAttribute("href");
                        const linkId = href.split("#")[1];
                        if (linkId === currentId) {
                            link.classList.add("active");
                        } else {
                            link.classList.remove("active");
                        }
                    });
    
                    // Якщо десктоп і є Swiper для зображень
                    if (window.innerWidth >= 768 && desktopSwiper) {
                        let currentStep = null;
    
                        steps.forEach(step => {
                            const rect = step.getBoundingClientRect();
                            if (rect.top >= 0 && rect.top < window.innerHeight / 2) {
                                currentStep = step;
                            }
                        });
    
                        if (currentStep) {
                            const stepIndex = Array.from(steps).indexOf(currentStep);
                            if (stepIndex !== -1) {
                                desktopSwiper.slideTo(stepIndex);
                            }
                        }
                    }
                }
            }


            function checkMode() {
                if (window.innerWidth < 883) {
                    deactivateScrollMode();
                } else {
                    activateScrollMode();
                }
            }

            window.addEventListener("resize", checkMode);
            checkMode();

            burger.addEventListener('click', function (e) {
                e.preventDefault();
                burger.classList.toggle('active');
                menu.classList.toggle('active');
                headerLine.classList.toggle('active');
                document.body.classList.toggle('lock');
            });
        });
    </script>


</body>

</html>