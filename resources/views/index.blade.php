@extends('layouts.app')
@section('content')
    <section class="hero-block items-center" id="about">
        <div class="wrapper">
            <div class="hero-block__content">
                <h1>Fully Serviced. <br> Fully Personalized.</h1>
                <p>Welcome to M&H Construction and Design. We specialize in thoughtful interior design and seamless project
                    execution — transforming concepts into real, stunning spaces.</p>
                <a href="" class="button-primary">Book a Consultation</a>
            </div>
        </div>
    </section>
    <section class="portfolio wrapper" id="portfolio">
        <div class="row g-5 portfolio-cards">
            <div class="col-12 col-md-4 col-lg-4 items-center">
                <div>
                    <h2>portfolio</h2>
                    <p>take a look at this short description and enjoy its beauty. And this sentence too...</p>
                    <a class="button-primary" href="">Get Started</a>
                </div>
            </div>

            @foreach ($projects as $index => $project)
                @if ($index > 4) @break @endif

                @php
                    // Встановлюємо класи відповідно до позиції
                    $classes = match ($index) {
                        0 => 'col-12 col-md-8 col-lg-8',
                        1 => 'col-12 col-sm-6 col-md-8 col-lg-8',
                        2 => 'col-12 col-sm-6 col-md-4 col-lg-4',
                        3 => 'col-12 col-sm-6 col-md-4 col-lg-4',
                        4 => 'col-12 col-sm-6 col-md-8 col-lg-8',
                        default => 'col-12',
                    };
                @endphp

                <div class="{{ $classes }}">
                    <a href="">
                        <img src="{{ asset('storage/' . $project["hero_image"]) }}" alt="">
                    </a>
                    <a href="#">{{ $project['title'] ?? '' }}</a>
                </div>
            @endforeach
        </div>

        @if(count($projects))
            <div class="swiper get-involved-swiper">
                <div class="swiper-wrapper">
                    @foreach ($projects as $project)
                        <div class="swiper-slide col-12">
                            <a href="">
                                <img src="{{ asset('storage/' . $project["hero_image"]) }}" alt="">
                            </a>
                            <a href="#">{{ $project['title'] ?? '' }}</a>
                        </div>
                    @endforeach
                </div>

                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        @endif

        <a href="{{ route('portfolio.index') }}">Full Portfolio</a>
    </section>

    <section class="services" id="services">
        <div class="wrapper">
            <h2>Services</h2>
        </div>
        <div class="service">
            <div class="wrapper">
                <div class="row">
                    <div class="service__title col-12 col-md-6">
                        <h3>Interior Design Project</h3>
                        <span>0.1</span>
                    </div>
                    <div class="service__description col-12 col-md-6">
                        <p>Design project is more than just “design” — it’s the visual blueprint for your renovated home.
                            It provides detailed documentation for contractors to understand tasks and locations clearly.
                            With us, you’ll grasp its elements and associated costs seamlessly.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="service">
            <div class="wrapper">
                <div class="row">
                    <div class="service__title col-12 col-md-6">
                        <h3>Custom Made Cabinetry</h3>
                        <span>0.2</span>
                    </div>
                    <div class="service__description col-12 col-md-6">
                        <p>Our custom-made cabinetry service offers a bespoke approach to home organization and design. From
                            concept
                            to installation, we work closely with you to ensure every detail is meticulously crafted to
                            perfection.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="service">
            <div class="wrapper">
                <div class="row">
                    <div class="service__title col-12 col-md-6">
                        <h3>Project Management</h3>
                        <span>0.3</span>
                    </div>
                    <div class="service__description col-12 col-md-6">
                        <p>Our project management service offers full-scale support from start to finish.
                            We oversee implementation, ensuring your real space precisely mirrors the design plan — on
                            time, on budget, and beautifully executed.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="service">
            <div class="wrapper">
                <div class="row">
                    <div class="service__title col-12 col-md-6">
                        <h3>Sourcing and Procurement</h3>
                        <span>0.4</span>
                    </div>
                    <div class="service__description col-12 col-md-6">
                        <p>This service includes comprehensive specification preparation: materials, furniture, and lighting
                            for each room.
                            You’ll receive item photos, collection names, sizes, materials, costs, and more.
                            Once the list is approved, we handle procurement and delivery — so everything arrives on-site,
                            ready to install.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="service">
            <div class="wrapper">
                <div class="row">
                    <div class="service__title col-12 col-md-6">
                        <h3>Project Realization</h3>
                        <span>0.5</span>
                    </div>
                    <div class="service__description col-12 col-md-6">
                        <p>From construction to final touches — we bring your interior to life with precision and care.
                            Our team coordinates every stage of the build, working with trusted contractors and artisans to
                            ensure flawless execution.
                            You get full control without the stress — we handle the hard part.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="how-we-work">
        <div class="wrapper">
            <h2>how we work</h2>
            <div class="row how-we-work__steps">
                <div class="col-12 col-md-6 step-image-container">
                    <img class="step-image" src="{{ asset('images/steps-img.webp') }}" alt="step 1">
                </div>
                <div class="col-12 col-md-6">
                    <h3 class="yellow-title">Design Project</h3>
                    <div class="step-card" data-img-src="{{ asset('images/step1.webp') }}">
                        <div class="d-flex">
                            <span class="number">1.</span>
                            <h3>Interior Design Survey, Questionnaire, Collection of References</h3>
                        </div>
                        <p>Our process begins with a site visit and measurement.
                            You complete a detailed questionnaire, helping us understand your goals.
                            We study your references and inspirations — identifying your style and vision.</p>
                    </div>
                    <div class="step-card" data-img-src="{{ asset('images/step2.webp') }}">
                        <div class="d-flex">
                            <span class="number">2.</span>
                            <h3>Schematic Design</h3>
                        </div>
                        <p>From construction to final touches — we bring your interior to life with precision and care.
                            Our team coordinates every stage of the build, working with trusted contractors and artisans to
                            ensure flawless execution.
                        </p>
                    </div>
                    <div class="step-card" data-img-src="{{ asset('images/step3.webp') }}">
                        <div class="d-flex">
                            <span class="number">3.</span>
                            <h3>Creating a Design Concept</h3>
                        </div>
                        <p>We develop a cohesive interior concept for every room.
                            Includes moodboards, materials, color schemes, and design language that defines the feel of your
                            future home.
                        </p>
                    </div>
                    <div class="step-card" data-img-src="{{ asset('images/step4.webp') }}">
                        <div class="d-flex">
                            <span class="number">4.</span>
                            <h3>Cost Estimation</h3>
                        </div>
                        <p>We calculate the investment needed to implement the chosen design — from furniture and
                            lighting to finishes and materials.
                        </p>
                    </div>
                    <div class="step-card" data-img-src="{{ asset('images/step5.webp') }}">
                        <div class="d-flex">
                            <span class="number">5.</span>
                            <h3>Contract Documentation</h3>
                        </div>
                        <p>Detailed visualizations, drawings, and specs that contractors use to execute everything to plan.
                        </p>
                    </div>
                    <div class="step-card" data-img-src="{{ asset('images/step6.webp') }}">
                        <div class="d-flex">
                            <span class="number">6.</span>
                            <h3>Final Presentation</h3>
                        </div>
                        <p>You receive a complete design package. We walk you through every element and prepare you
                            for the implementation phase.
                        </p>
                    </div>
                    <h3 class="yellow-title">Implementation <br> of the Design Project</h3>
                    <div class="step-card" data-img-src="{{ asset('images/step7.webp') }}">
                        <div class="d-flex">
                            <span class="number">1.</span>
                            <h3>Construction-Ready Documentation</h3>
                        </div>
                        <p>We create complete visualizations, 3D models, and technical drawings.
                            This allows you to see your future interior in detail, and gives contractors precise guidance
                            for
                            flawless execution.
                        </p>
                    </div>
                    <div class="step-card" data-img-src="{{ asset('images/step8.webp') }}">
                        <div class="d-flex">
                            <span class="number">2.</span>
                            <h3>Project Oversight &amp; Quality Control</h3>
                        </div>
                        <p>Our team supervises all construction stages, ensuring everything is built according to the
                            approved design and specifications.
                        </p>
                    </div>
                    <div class="step-card" data-img-src="{{ asset('images/step9.webp') }}">
                        <div class="d-flex">
                            <span class="number">3.</span>
                            <h3>Hiring the Best Contractors and Realization Team</h3>
                        </div>
                        <p>We bring in vetted contractors and top specialists to ensure the execution is done by
                            professionals who share our commitment to quality and precision.
                        </p>
                    </div>
                    <div class="step-card" data-img-src="{{ asset('images/step10.webp') }}">
                        <div class="d-flex">
                            <span class="number">4.</span>
                            <h3>Home Decoration and Touch-Up</h3>
                        </div>
                        <p>Before you move in, we take care of the final styling: furniture placement, decor accents,
                            lighting
                            adjustment, and a full space walkthrough — so everything is polished, complete, and ready to
                            welcome you.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="get-involved wrapper">
        <div class="row items-center g-5">
            <div class="col-12 col-md-4 col-lg-4">
                <h2>Get Involved</h2>
                <p>Our talented squad is eager to make your dream space a reality.
                    Don’t wait — let’s start making magic together!</p>
                <a class="button-primary" href="">Get in Touch</a>
            </div>
            <div class="col-12 col-md-8 col-lg-8">
                <img src="{{ asset("images/get-involved-img.webp") }}" alt="">
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.get-involved-swiper', {
            slidesPerView: 1,
            spaceBetween: 24,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            loop: true,
        });
    </script>


@endsection


<!-- 
@section('content')
  <h2>Contact Request Form</h2>
  <form id="contactForm">
    <label>Full Name: <input type="text" name="full_name" required></label><br />
    <label>Email: <input type="email" name="email" required></label><br />
    <label>Phone: <input type="text" name="phone"></label><br />
    <label>How did you hear about us? <input type="text" name="how_heard"></label><br />
    <label>Services:
      <select name="services_selected[]" multiple>
        <option value="Розробка сайту">Розробка сайту</option>
        <option value="SEO">SEO</option>
        <option value="Реклама">Реклама</option>
      </select>
    </label><br />
    <label>Project Details:<br />
      <textarea name="project_details"></textarea>
    </label><br />
    <button type="submit">Send</button>
  </form>

  <script>
    // Функція, щоб отримати параметри з URL

    function getQueryParam(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    const gclid = getQueryParam('gclid');
    if (gclid) {
        localStorage.setItem('gclid', gclid);
    }

    const clientId = getQueryParam('client_id');
    if (clientId) {
        localStorage.setItem('client_id', clientId);
    }


    document.getElementById('contactForm').addEventListener('submit', async function (e) {
      e.preventDefault();

      const formData = new FormData(this);

      // Формуємо об'єкт з полями форми
      const data = Object.fromEntries(formData.entries());

      // Обробка мультиселекту (services_selected)
      data.services_selected = formData.getAll('services_selected[]');

      // Додаємо автоматичні поля
      data.gclid = localStorage.getItem('gclid') || null;
      data.client_id = localStorage.getItem('client_id') || null;
      data.referrer = document.referrer || null;
      data.page_url = window.location.href;

      // Відправляємо POST-запит на бекенд
      try {
        const response = await fetch('http://127.0.0.1:8000/api/contact', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(data)
        });

        if (!response.ok) {
          const errorData = await response.json();
          alert('Помилка: ' + JSON.stringify(errorData));
          return;
        }

        const result = await response.json();
        alert('Дякуємо! Ваша заявка прийнята.');

        this.reset(); // Очищаємо форму
      } catch (err) {
        alert('Сталася помилка при відправці: ' + err.message);
      }
    });
  </script> -->