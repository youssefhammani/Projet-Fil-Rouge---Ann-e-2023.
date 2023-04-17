@extends('home')

@section('content')
    <section class="light">
        <div class="container py-2">
            <div class="h1 text-center text-dark" id="pageHeaderTitle"></div>
            <div class="section-header">
                <h2>Events</h2>
                <p>Share <span>Your Moments</span> In Our Restaurant</p>
            </div>

            @foreach ($events as $event)
                <article class="postcard light blue">
                    <a class="postcard__img_link" href="#">
                        <img class="postcard__img" src="https://picsum.photos/1000/1000" alt="Image Title" />
                    </a>
                    <div class="postcard__text t-dark">
                        <h1 class="postcard__title blue"><a href="#">{{ $event->title }}</a></h1>
                        <div class="postcard__subtitle small">
                            <time datetime="2020-05-25 12:00:00">
                              <i class="bi bi-calendar-check"></i> {{ $event->event_time }}
                            </time>
                        </div>
                        <div class="postcard__bar"></div>
                        <div class="postcard__preview-txt">{{ $event->description }} Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Fuga vero corporis sed consequuntur numquam, praesentium optio et, iure saepe
                            magni impedit molestias tempore illum maiores autem, alias placeat tempora incidunt.</div>
                        <ul class="postcard__tagbox">
                            <li class="tag__item"><i class="bi bi-clock"></i> {{ $event->start_time }}</li>
                            <li class="tag__item"><i class="bi bi-clock-fill"></i> {{ $event->end_time }}</li>
                            <li class="tag__item play blue">
                                <a href="#"><i class="bi bi-ticket-detailed"></i> Buy your ticket</a>
                            </li>
                        </ul>
                    </div>
                </article>
            @endforeach

        </div>
    </section>
@endsection
