@extends('layouts.app')

@section('content')
    <section class="project wrapper">
        <h1>{{$project->title}}</h1>
        <div class="row project-description-row">
            <div class="col-12 col-md-4 col-lg-4">
                <p>{{$project->description}}</p>
                <table>
                    <tr>
                        <td>Area</td>
                        <td>{{$project->area}} m<sup>2</sup></td>
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
            <div class="col-12 col-md-8 col-lg-8">
                <img src="{{ asset('storage/' . $project->hero_image) }}" alt="">
            </div>
        </div>
        @if ($project->galleryItems->isNotEmpty())
            <div class="project-gallery">
                <h2>FROM CONCEPT TO REALIZATION</h2>
                @foreach($project->galleryItems as $item)
                    <div class="gallery-item">
                        <img src="{{ asset('storage/' . $item->design_image) }}" alt="Design" class="design-image">
                    </div>
                @endforeach
                <h3>realization</h3>
                @foreach($project->galleryItems as $item)
                    <div class="gallery-item">
                        <img src="{{ asset('storage/' . $item->real_image) }}" alt="Reality" class="reality-image">
                    </div>
                @endforeach
            </div>
        @endif
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

    <script>
        window.addEventListener('load', function () {
            const textBlock = document.querySelector('.project-description-row > .col-lg-4');
            const imageBlock = document.querySelector('.project-description-row > .col-lg-8 img');

            if (textBlock && imageBlock) {
                const textHeight = textBlock.offsetHeight;

                imageBlock.style.height = textHeight + 'px';
                imageBlock.style.objectFit = 'cover';
                imageBlock.style.width = '100%';
            }
        });

        window.addEventListener('resize', function () {
            const textBlock = document.querySelector('.project-description-row > .col-lg-4');
            const imageBlock = document.querySelector('.project-description-row > .col-lg-8 img');

            if (textBlock && imageBlock) {
                const textHeight = textBlock.offsetHeight;
                imageBlock.style.height = textHeight + 'px';
            }
        });
    </script>
@endsection