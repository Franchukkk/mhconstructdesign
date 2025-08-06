@extends('layouts.app')

@section('content')
    <section class="project wrapper">
        <div class="image-detail-popup" id="imageDetailPopup" style="display:none;">
            <span class="close-btn" id="popupCloseBtn">&times;</span>
            <img src="" alt="Fullscreen Image" id="popupImage" />
        </div>

        <h1>{{$project->title}}</h1>
        <div class="row project-description-row">
            <div class="col-12 col-md-6 col-xl-4">
                <p>{{$project->description}}</p>
                <table>
                    <tr>
                        <td>Area</td>
                        <td>{{$project->area}} ft<sup>2</sup></td>
                    </tr>
                    <tr>
                        <td>Realisation</td>
                        <td>{{$project->implementation_time}} month</td>
                    </tr>
                    <tr>
                        <td>Project development</td>
                        <td>{{$project->design_time}} month</td>
                    </tr>
                    <tr>
                        <td>Style</td>
                        <td>{{$project->style}}</td>
                    </tr>
                    <tr>
                        <td>Location</td>
                        <td>{{$project->location}}</td>
                    </tr>
                </table>
                <a href="{{ route('contact-request.form') }}" class="button-primary">I Want The Same</a>
            </div>
            <div class="col-12 col-md-6 col-xl-8">
                <img src="{{ asset('storage/' . ($project->portfolio_cover != null ? $project->portfolio_cover : $project->hero_image)) }}"
                    alt="">
            </div>
        </div>
        @php
            $images = $project->galleryItems
                ->flatMap(fn($item) => [$item->design_image, $item->real_image])
                ->filter(fn($path) => !empty($path))
                ->values();
        @endphp
        @if ($images->isNotEmpty())
            <div class="project-gallery">
                <h2>FROM CONCEPT TO REALIZATION</h2>
            </div>
        @endif

        <!-- <div class="portfolio">
            @if ($images->isNotEmpty())
                <div class="row g-5 project-gallery">
                    @foreach ($images as $index => $image)
                        @php
                            $pairIndex = intdiv($index, 2);
                            $isFirstInPair = $index % 2 === 0;

                            if ($pairIndex % 2 === 0) {
                                $class = $isFirstInPair ? 'col-4' : 'col-8';
                            } else {
                                $class = $isFirstInPair ? 'col-8' : 'col-4';
                            }
                        @endphp

                        <div class="{{ $class }}">
                            <img class="gallery-image" src="{{ asset('storage/' . $image) }}" alt="Project Image"
                                class="img-fluid w-100" />
                        </div>
                    @endforeach
                </div>
            @endif
        </div> -->
        <div class="portfolio portfolio-projects-gallery-center">
            @if ($images->isNotEmpty())
                <div class="row g-5 project-gallery">
                    @foreach ($real_images as $index => $image)
                        <div class="col-12">
                            <img class="gallery-image" src="{{ asset('storage/' . $image) }}" alt="">
                        </div>
                    @endforeach
                    <h3>Realisation</h3>
                    @foreach ($design_images as $index => $image)
                        <div class="col-12">
                            <img class="gallery-image" src="{{ asset('storage/' . $image) }}" alt="">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="get-involved wrapper">
        <div class="row items-center g-5">
            <div class="col-12 col-md-4 col-lg-4">
                <h2>Let’s discuss your project</h2>
                <p>Ready to bring your ideas to life?</p>
                <a class="button-primary" href="{{ route("contact-request.form") }}">Start the Conversation</a>
            </div>
            <div class="col-12 col-md-8 col-lg-8">
                <img src="{{ asset("images/get-involved-img-2.webp") }}" alt="">
            </div>
        </div>
    </section>

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" /> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> -->

    <script>
        // $(document).ready(function () {
        //     const designSlider = $('.design-slider').slick({
        //         slidesToShow: 3,
        //         slidesToScroll: 1,
        //         autoplay: true,
        //         autoplaySpeed: 3000,
        //         arrows: false,
        //         dots: false,
        //         pauseOnHover: false,
        //         responsive: [
        //             { breakpoint: 992, settings: { slidesToShow: 2 } },
        //             { breakpoint: 768, settings: { slidesToShow: 1 } }
        //         ]
        //     });

        //     const realitySlider = $('.reality-slider').slick({
        //         slidesToShow: 3,
        //         slidesToScroll: 1,
        //         autoplay: true,
        //         autoplaySpeed: 3000,
        //         arrows: false,
        //         dots: false,
        //         pauseOnHover: false,
        //         responsive: [
        //             { breakpoint: 992, settings: { slidesToShow: 2 } },
        //             { breakpoint: 768, settings: { slidesToShow: 1 } }
        //         ]
        //     });

        //     if (window.innerWidth > 991) {
        //         $('.design-slider, .reality-slider').on('mouseenter', function () {
        //             designSlider.slick('slickPause');
        //             realitySlider.slick('slickPause');
        //         });

        //         $('.design-slider, .reality-slider').on('mouseleave', function () {
        //             designSlider.slick('slickPlay');
        //             realitySlider.slick('slickPlay');
        //         });
        //     }

        // });

        function adjustHeroImageHeight() {
            const textBlock = document.querySelector('.project-description-row > .col-xl-4');
            const imageBlock = document.querySelector('.project-description-row > .col-xl-8 img');

            if (!imageBlock) {
                return;
            }

            if (window.innerWidth > 769) {
                if (textBlock) {
                    const textHeight = textBlock.offsetHeight;
                    console.log('✅ Text block height:', textHeight);
                    imageBlock.style.height = textHeight + 'px';
                    imageBlock.style.objectFit = 'cover';
                    imageBlock.style.width = '100%';
                }
            } else {
                imageBlock.style.height = '';
                imageBlock.style.width = '100%';
                imageBlock.style.aspectRatio = '1 / 1';
                imageBlock.style.objectFit = 'cover';
            }
        }



        window.addEventListener('load', adjustHeroImageHeight);
        window.addEventListener('resize', adjustHeroImageHeight);


        document.addEventListener('DOMContentLoaded', function () {
            const popup = document.getElementById('imageDetailPopup');
            const popupImage = document.getElementById('popupImage');
            const closeBtn = document.getElementById('popupCloseBtn');
            const headerLine = document.querySelector(".header-line");

            // Відкриваємо попап по кліку на будь-яке зображення галереї
            document.querySelectorAll('.gallery-image').forEach(img => {
                img.addEventListener('click', () => {
                    headerLine.style.top = "-200px";
                    setTimeout(() => {
                        popupImage.src = img.src;
                        popup.style.display = 'flex';
                        // Забираємо прокрутку сторінки
                        document.body.style.overflow = 'hidden';

                    }, 100);
                });
            });

            // Закриття попапа по кліку на хрестик
            closeBtn.addEventListener('click', () => {
                popup.style.display = 'none';
                popupImage.src = '';
                document.body.style.overflow = '';
                headerLine.style.top = "0"
            });

            // Закриття попапа по кліку поза зображенням
            popup.addEventListener('click', (e) => {
                if (e.target === popup) {
                    popup.style.display = 'none';
                    popupImage.src = '';
                    document.body.style.overflow = '';
                    headerLine.style.top = "0";
                }
            });

            // Закриття по клавіші Escape
            document.addEventListener('keydown', (e) => {
                if (e.key === "Escape" && popup.style.display === 'flex') {
                    popup.style.display = 'none';
                    popupImage.src = '';
                    document.body.style.overflow = '';
                    headerLine.style.top = "0"
                }
            });
        });

    </script>
@endsection