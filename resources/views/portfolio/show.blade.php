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
                    <caption
                        style="position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(1px, 1px, 1px, 1px);">
                        {{ $project->title }}
                    </caption>
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
            @if (count($design_images) > 0)
                <div class="row g-5 project-gallery project-gallery--parent">
                    @for ($i = 0; $i < count($design_images); $i += 2)
                        <div class="col-6">
                            <img loading="lazy" class="gallery-image" src="{{ asset('storage/' . $design_images[$i]['path']) }}"
                                alt="Design visualization - Render image {{ $i + 1 }}">
                        </div>

                        @if (isset($design_images[$i + 1]))
                            <div class="col-6">
                                <img loading="lazy" class="gallery-image" src="{{ asset('storage/' . $design_images[$i + 1]['path']) }}"
                                    alt="Design visualization - Render image {{ $i + 2 }}">
                            </div>
                        @endif

                        @php
                            $descIndex = intdiv($i, 2);
                        @endphp

                        @if (!empty($designDescriptions[$descIndex]))
                            <div class="col-12">
                                <p class="image-description">{{ $designDescriptions[$descIndex] }}</p>
                            </div>
                        @endif
                    @endfor

                    @if(count($real_images) > 0 && count($design_images) > 0)
                        <h3>Realisation</h3>
                    @endif

                    @for ($i = 0; $i < count($real_images); $i += 2)
                        <div class="col-6">
                            <img loading="lazy" class="gallery-image" src="{{ asset('storage/' . $real_images[$i]['path']) }}"
                                alt="Photo of completed project - Realisation image {{ $i + 1 }}">
                        </div>

                        @if (isset($real_images[$i + 1]))
                            <div class="col-6">
                                <img loading="lazy" class="gallery-image" src="{{ asset('storage/' . $real_images[$i + 1]['path']) }}"
                                    alt="Photo of completed project - Realisation image {{ $i + 2 }}">
                            </div>
                        @endif

                        @php
                            $descIndex = intdiv($i, 2);
                        @endphp

                        @if (!empty($realDescriptions[$descIndex]))
                            <div class="col-12">
                                <p class="image-description">{{ $realDescriptions[$descIndex] }}</p>
                            </div>
                        @endif
                    @endfor
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
        // Передаємо опис із Blade у JS змінні (тут у шаблоні, заміни на свої змінні)
        window.designDescriptions = @json($designDescriptions ?? []);
        window.realDescriptions = @json($realDescriptions ?? []);


        function adjustHeroImageHeight() {
            const textBlock = document.querySelector('.project-description-row > .col-xl-4');
            const imageBlock = document.querySelector('.project-description-row > .col-xl-8 img');

            if (!imageBlock) {
                return;
            }

            if (window.innerWidth > 769) {
                if (textBlock) {
                    const textHeight = textBlock.offsetHeight;
                    imageBlock.style.height = textHeight + 'px';
                    imageBlock.style.objectFit = 'contain';
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

        window.addEventListener('load', () => {
            adjustHeroImageHeight();
        });

        window.addEventListener('resize', adjustHeroImageHeight);
    </script>


@endsection