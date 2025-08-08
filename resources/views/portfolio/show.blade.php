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
                    <caption style="position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(1px, 1px, 1px, 1px);">{{ $project->title }}</caption>
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

            @php
                use Illuminate\Support\Str;
            @endphp

            <div class="col-12 col-md-6 col-xl-8">
                <img src="{{ asset('storage/' . ($project->portfolio_project_page_cover ?? $project->portfolio_cover)) }}"
                    alt="{{ $project->title }} — {{ Str::contains($project->portfolio_project_page_cover ?? $project->portfolio_cover, 'render') ? '3D visualization' : 'Completed project photo' }} by M&H Construct and Design.">
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
                <div class="row g-5 project-gallery project-gallery--parent">
                    @foreach ($real_images as $index => $image)
                        <div class="col-6">
                            <img loading="lazy" class="gallery-image" src="{{ asset('storage/' . $image) }}"
                                alt="Photo of completed project - Realisation image {{ $index + 1 }}">>
                        </div>
                    @endforeach
                    @if ($project->design_description != null && $project->design_description !== '')
                        <p>{{$project->design_description}}</p>
                    @endif
                    @if($real_images->isNotEmpty() && $design_images->isNotEmpty())
                        <h3>Realisation</h3>
                    @endif
                    @foreach ($design_images as $index => $image)
                        <div class="col-6">
                            <img loading="lazy" class="gallery-image" src="{{ asset('storage/' . $image) }}"
                                alt="Design visualization - Render image {{ $index + 1 }}">
                        </div>
                    @endforeach
                    @if ($project->realization_description != null && $project->realization_description !== '')
                        <p>{{$project->realization_description}}</p>
                    @endif
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
                <img loading="lazy" src="{{ asset("images/get-involved-img-2.webp") }}"
                    alt="Team of designers ready to turn your vision into reality — join the creative journey with M&H Construct and Design.">
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


            document.querySelectorAll('.gallery-image').forEach(img => {
                img.addEventListener('click', () => {
                    headerLine.style.top = "-200px";
                    setTimeout(() => {
                        popupImage.src = img.src;
                        popup.style.display = 'flex';

                        document.body.style.overflow = 'hidden';

                    }, 100);
                });
            });

            closeBtn.addEventListener('click', () => {
                popup.style.display = 'none';
                popupImage.src = '';
                document.body.style.overflow = '';
                headerLine.style.top = "0"
            });

            popup.addEventListener('click', (e) => {
                if (e.target === popup) {
                    popup.style.display = 'none';
                    popupImage.src = '';
                    document.body.style.overflow = '';
                    headerLine.style.top = "0";
                }
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === "Escape" && popup.style.display === 'flex') {
                    popup.style.display = 'none';
                    popupImage.src = '';
                    document.body.style.overflow = '';
                    headerLine.style.top = "0"
                }
            });
        });

        function sortAndGroupGallery() {
            const container = document.querySelector('.project-gallery--parent');
            if (!container) {
                console.warn('Контейнер .project-gallery--parent не знайдено');
                return;
            }

            const allImages = Array.from(document.querySelectorAll('.gallery-image'));

            const realImages = [];
            const designImages = [];

            allImages.forEach(img => {
                const alt = img.alt.toLowerCase();
                if (alt.includes('realisation') || alt.includes('real')) {
                    realImages.push(img);
                } else if (alt.includes('design') || alt.includes('render')) {
                    designImages.push(img);
                }
            });

            function getImageRatio(img) {
                return img.naturalWidth / img.naturalHeight;
            }

            function sortImagesByRatio(images) {
                return new Promise(resolve => {
                    Promise.all(images.map(img => {
                        return new Promise(r => {
                            if (img.complete) {
                                r({ img, ratio: getImageRatio(img) });
                            } else {
                                img.onload = () => r({ img, ratio: getImageRatio(img) });
                                img.onerror = () => r({ img, ratio: 1 });
                            }
                        });
                    })).then(imagesData => {
                        imagesData.sort((a, b) => a.ratio - b.ratio);
                        resolve(imagesData);
                    });
                });
            }

            container.innerHTML = '';

            Promise.all([sortImagesByRatio(designImages), sortImagesByRatio(realImages)]).then(([sortedDesign, sortedReal]) => {
                if (sortedDesign.length) {
                    const designRow = document.createElement('div');
                    designRow.classList.add('row', 'g-5');
                    sortedDesign.forEach(({ img }) => {
                        const col = document.createElement('div');
                        col.classList.add('col-6');
                        col.appendChild(img);
                        designRow.appendChild(col);
                    });
                    container.appendChild(designRow);
                }

                if (sortedReal.length) {
                    const h3 = document.createElement('h3');
                    h3.textContent = 'Realisation';
                    container.appendChild(h3);

                    const realRow = document.createElement('div');
                    realRow.classList.add('row', 'g-5');
                    sortedReal.forEach(({ img }) => {
                        const col = document.createElement('div');
                        col.classList.add('col-6');
                        col.appendChild(img);
                        realRow.appendChild(col);
                    });
                    container.appendChild(realRow);
                }
            });
        }

        window.addEventListener('load', () => {
            adjustHeroImageHeight();
            sortAndGroupGallery();
        });

        window.addEventListener('resize', adjustHeroImageHeight);
    </script>

@endsection