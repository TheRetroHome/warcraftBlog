@extends('layouts.head')
@section('content')
<section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">warcraftBlog</h1>
        <p class="lead text-muted">Поиск по блогу:</p>
        <form class="d-flex" method="GET" action="{{route('search')}}">
            <input class="form-control me-2" type="search" name="s" placeholder="Введите запрос..." aria-label="Search">
            <button type="submit" class="btn btn-outline-success">Поиск</button>
        </form>
      </div>
    </div>
  </section>



  <div class="album py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <form action="{{ route('home') }}" method="GET" class="d-flex justify-content-end">
                    <select name="sort_by" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                        <option value="newest" {{ request('sort_by') == 'newest' ? 'selected' : '' }}>Самые новые</option>
                        <option value="likes" {{ request('sort_by') == 'likes' ? 'selected' : '' }}>По лайкам</option>
                        <option value="views" {{ request('sort_by') == 'views' ? 'selected' : '' }}>По просмотрам</option>
                    </select>
                </form>
            </div>
        </div>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
              @foreach($posts as $post)
        <div class="col">
          <div class="card shadow-sm">
              <img src="{{ $post->getImage() }}" class="card-img-top" alt="Post thumbnail" width="100%" height="225">
            <div class="card-body">
              <a class="card-text" href="{{route('post.single', ['slug' => $post->slug])}}">{{$post->title}}</a>
              <p class="card-text">{{$post->description}}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <a href="{{ route('post.single', ['slug' => $post->slug]) }}" class="btn btn-sm btn-outline-secondary">View</a>
                    @admin
                    <a href="{{ route('post.edit',['post'=>$post->id])}}" class="btn btn-sm btn-outline-secondary">Edit</a>
                    <a href="{{ route('post.destroy', ['post' => $post->id]) }}" class="btn btn-sm btn-outline-secondary" onclick="return confirm('Вы уверены, что хотите удалить этот пост?')">Delete</a>
                    @endadmin
                </div>
            <div class="d-flex justify-content-between align-items-center">
                <!-- ... -->
                <span class="view-icon">
                    <i class="fas fa-eye"></i> {{$post->views}}
                </span>
                <span>
                    <i class="fas fa-heart"></i> {{$post->likes->count()}}
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
           <div class="card-footer clearfix">
               {!! $pagination  !!}
          </div>

      </div>
    </div>
  </div>

@endsection
