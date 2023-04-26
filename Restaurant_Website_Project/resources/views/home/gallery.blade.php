@extends('home')

@section('content')
    <section class="m-5">
        <div class="section-header" data-aos="fade-up">
            <h2>gallery</h2>
            <p>Check <span>Our Gallery</span></p>
        </div>
        <!-- Gallery -->
        <div class="row">
            <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                <img src="{{ asset('assets/img/gallery/gallery-1.jpg') }}"
                    class="w-100 shadow-1-strong rounded mb-4" data-aos="fade-down-right" data-aos-delay="200" alt="Boat on Calm Water" />

                <img src="{{ asset('assets/img/gallery/gallery-2.jpg') }}"
                    class="w-100 shadow-1-strong rounded mb-4" data-aos="fade-up-right" data-aos-delay="200" alt="Wintry Mountain Landscape" />
            </div>

            <div class="col-lg-4 mb-4 mb-lg-0">
                <img src="{{ asset('assets/img/gallery/gallery-3.jpg') }}"
                    class="w-100 shadow-1-strong rounded mb-4" data-aos="fade-down" data-aos-delay="200" alt="Mountains in the Clouds" />

                <img src="{{ asset('assets/img/gallery/gallery-4.jpg') }}"
                    class="w-100 shadow-1-strong rounded mb-4" data-aos="fade-up" data-aos-delay="200" alt="Boat on Calm Water" />
            </div>

            <div class="col-lg-4 mb-4 mb-lg-0">
                <img src="{{ asset('assets/img/gallery/gallery-5.jpg') }}"
                    class="w-100 shadow-1-strong rounded mb-4" data-aos="fade-down-left" data-aos-delay="200" alt="Waves at Sea" />

                <img src="{{ asset('assets/img/gallery/gallery-6.jpg') }}"
                    class="w-100 shadow-1-strong rounded mb-4" data-aos="fade-up-left" data-aos-delay="200" alt="Yosemite National Park" />
            </div>
        </div>
        <!-- Gallery -->
    </section>
@endsection
