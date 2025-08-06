@extends('layouts.app')

@section('content')
    <div class="overflow-x-hidden">
        <section class="contact-request wrapper">
            <p class="contact-request-description">
                IF OUR HOMES ARE GOING TO BE PLACES OF REPRIEVE, <br>
                REJUVENATION, AND INSPIRATION, <br>
                THEY MUST ALSO BE PLACES OF BEAUTY. <br>
                IT’S TIME TO CREATE A HOME THAT NURTURES YOUR SOUL. <br>
                SCHEDULE YOUR DISCOVERY CALL BELOW <br>
            </p>

            @if(session('success'))
                <p class="alert" style="color: green;">{{ session('success') }}</p>
            @endif

            @if($errors->any())
                <ul style="color: red;">
                    @foreach($errors->all() as $error)
                        <li class="alert">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="row g-101">
                <div class="col-12 col-lg-6">
                    <h1>Let’s talk about your project</h1>
                    <form id="contactForm" action="{{ route('contact-request.submit') }}" method="POST">
                        @csrf
                        <div id="formStep1">
                            <div class="row g-29 mb-25">
                                <div class="col-12 col-lg-6">
                                    <label>
                                        <p>Full name</p>
                                        <input type="text" name="full_name" placeholder="Tony Stark"
                                            value="{{ old('full_name') }}" required>
                                    </label>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label>
                                        <p>Email</p>
                                        <input class="email" type="email" name="email" placeholder="Stark@gmail.com"
                                            value="{{ old('email') }}" required>
                                        <p id="emailError" style="color: red; margin-top: 10px; font-size: 20rem;"></p>
                                    </label>
                                </div>
                            </div>

                            <div class="row g-29 mb-25">
                                <div class="col-12 col-lg-6">
                                    <label>
                                        <p>Phone number</p>
                                        <input id="phoneInput" type="tel" name="phone" placeholder="(000) 000-0000"
                                            value="{{ old('phone') }}">
                                        <p id="phoneError" style="color: red; margin-top: 10px; font-size: 20rem;"></p>
                                    </label>

                                </div>
                                <div class="col-12 col-lg-6">
                                    <label>
                                        <p>How did you hear about “m&H”?</p>
                                        <select name="how_heard">
                                            <option value="From Friends" @selected(old('how_heard') == 'From Friends')>From
                                                Friends
                                            </option>
                                            <option value="Instagram" @selected(old('how_heard') == 'Instagram')>Instagram
                                            </option>
                                            <option value="Google" @selected(old('how_heard') == 'Google')>Google</option>
                                            <option value="Other" @selected(old('how_heard') == 'Other')>Other</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="row mb-25">
                                <div class="col-12">
                                    <label>
                                        <p>Property Address</p>
                                        <input type="text" name="page_url" id="page_url"
                                            placeholder="23 Main Street, Anytown, CA 91234" value="{{ old('page_url') }}">
                                    </label>
                                </div>
                            </div>

                            <p class="mb-25">What can we help you with?</p>
                            <div class="d-flex checkboxes-mb gap-29 mb-25">
                                <label class="checkbox">
                                    <input type="checkbox" name="services_selected[]" value="Renovation"
                                        @checked(is_array(old('services_selected')) && in_array('Renovation', old('services_selected')))>
                                        Renovation
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" name="services_selected[]" value="Full Interior Design Package "
                                        @checked(is_array(old('services_selected')) && in_array('Full Interior Design Package ', old('services_selected')))>
                                    Full Interior Design Package 
                                </label>
                            </div>

                            <div class="d-flex checkboxes-mb gap-29 mb-105">
                                <label class="checkbox">
                                    <input type="checkbox" name="services_selected[]" value="Custom New Build Project"
                                        @checked(is_array(old('services_selected')) && in_array('Custom New Build Project', old('services_selected')))>
                                        Custom New Build Project
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" name="services_selected[]" value="Full-service design"
                                        @checked(is_array(old('services_selected')) && in_array('Full-service design', old('services_selected')))>
                                    Furnishing and Styling
                                </label>
                            </div>

                            <button id="nextBtn" class="button-primary" type="button">Next</button>
                        </div>
                        <div id="formStep2" style="display: none;">
                            <div class="row mb-25">
                                <div class="col-12">
                                    <label>
                                        <p>Could you please share more details about your project?</p>
                                        <textarea name="project_details" placeholder="Type here"
                                            required>{{ old('project_details') }}</textarea>
                                        <p>Timeframe & Flexibilit (This isn't required)</p>
                                        <textarea name="timeframe_flexibility" placeholder="Type here"
                                                  >{{ old('timeframe_flexibility') }}</textarea>
                                        <p>How would you describe your design style? (This isn't required)</p>
                                        <textarea name="design_style_description" placeholder="Type here"
                                                  >{{ old('design_style_description') }}</textarea>
                                    </label>
                                </div>
                            </div>

                            <button class="button-primary" type="submit">Submit</button>
                        </div>

                        <!-- Hidden Fields -->
                        <input type="hidden" name="gclid" id="gclid">
                        <input type="hidden" name="client_id" id="client_id">
                        <input type="hidden" name="referrer" id="referrer">
                    </form>
                </div>

                <div class="col-12 col-lg-6" id="contactImageParentContainer">
                    <img id="contactImage" src="{{ asset('images/contact.webp') }}" alt="">
                </div>
            </div>
        </section>
    </div>

    <script>
        function getQueryParam(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        const gclid = getQueryParam('gclid');
        if (gclid) localStorage.setItem('gclid', gclid);

        const clientId = getQueryParam('client_id');
        if (clientId) localStorage.setItem('client_id', clientId);

        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        document.addEventListener('DOMContentLoaded', function () {
            const contactForm = document.getElementById('contactForm');
            const nextBtn = document.getElementById('nextBtn');
            const step1 = document.getElementById('formStep1');
            const step2 = document.getElementById('formStep2');

            const phoneInput = document.getElementById('phoneInput');
            const phoneError = document.getElementById('phoneError');
            const emailInput = contactForm.querySelector('input[name="email"]');
            const emailError = document.getElementById('emailError');

            phoneInput.addEventListener('input', function () {
                this.value = this.value.replace(/[^0-9()\-\s+]/g, '');
                phoneError.textContent = '';
            });

            phoneInput.addEventListener('blur', function () {
                const digits = this.value.replace(/\D/g, '');
                if (digits.length < 10) {
                    phoneError.textContent = 'Please enter at least 10 digits in your phone number.';
                } else {
                    phoneError.textContent = '';
                }
            });

            nextBtn.addEventListener('click', function () {
                const requiredFields = contactForm.querySelectorAll('#formStep1 input[required], #formStep1 select[required]');
                let valid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.style.border = '1px solid red';
                        valid = false;
                    } else {
                        field.style.border = '';
                    }
                });

                // Валідація email
                if (!validateEmail(emailInput.value.trim())) {
                    emailError.textContent = 'Please enter a valid email address.';
                    emailInput.style.border = '1px solid red';
                    valid = false;
                } else {
                    emailError.textContent = '';
                    emailInput.style.border = '';
                }

                const digits = phoneInput.value.replace(/\D/g, '');
                if (digits.length < 10) {
                    phoneError.textContent = 'Please enter at least 10 digits in your phone number.';
                    valid = false;
                }

                if (valid) {
                    step1.style.display = 'none';
                    step2.style.display = 'block';
                }
            });

            contactForm.addEventListener('submit', function () {
                document.getElementById('gclid').value = localStorage.getItem('gclid') || '';
                document.getElementById('client_id').value = localStorage.getItem('client_id') || '';
                document.getElementById('referrer').value = document.referrer || '';
                document.getElementById('page_url').value = window.location.href;
            });
        });

    </script>



@endsection
