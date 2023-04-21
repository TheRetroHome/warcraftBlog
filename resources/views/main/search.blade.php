@extends('layouts.head')
@section('content')
<div class="album py-5 bg-light">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      @if($posts->count())
                <div class="col-12 mb-3">
                    <h4 class="text-center text-primary">По вашему запросу было найдено: {{$posts->count()}} записей</h4>
                </div>
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
            @else
                <div class="col-12 mb-3">
                    <h4 class="text-center text-primary">По вашему запросу ничего не было найдено</h4>
                </div>
            @endif
                       <div class="card-footer clearfix">
                           {!! $pagination  !!}
                      </div>

      </div>
    </div>
  </div>
@endsection
