@extends('layouts.head')
@section('content')
 <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Album example</h1>
        <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
        <p>
          <a href="#" class="btn btn-primary my-2">Main call to action</a>
          <a href="#" class="btn btn-secondary my-2">Secondary action</a>
        </p>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
              @foreach($posts as $post)
        <div class="col">
          <div class="card shadow-sm">
              <img src="{{ $post->getImage() }}" class="card-img-top" alt="Post thumbnail" width="100%" height="225">
            <div class="card-body">
              <p class="card-text">{{$post->title}}</p>
              <p class="card-text">{{$post->description}}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                </div>
            <div class="d-flex justify-content-between align-items-center">
                <!-- ... -->
                <span class="view-icon">
                    <i class="fas fa-eye"></i> {{$post->views}}
                </span>
                <span class="post-date">{{$post->getPostDate()}}</span>
            </div>
              </div>
            </div>
          </div>
        </div>
        <style>
        .view-icon {
            margin-right: 10px; /* Устанавливает отступ справа для иконки просмотров */
        }

        .post-date {
            margin-left: 10px; /* Устанавливает отступ слева для даты */
        }

        </style>
            @endforeach


      </div>
    </div>
  </div>

@endsection
