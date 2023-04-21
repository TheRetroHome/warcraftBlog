@extends('layouts.head')
@section('content')
 <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <h2>{{$post->title}}</h2>
                    </div>
                    <img src="{{ $post->getImage() }}" class="card-img-top" alt="аватарка">
                    <div class="card-body">
                        <blockquote class="blockquote">
                            <p>{{$post->description}}</p>
                        </blockquote>
                        <p class="card-text">{{$post->content}}</p>
                        <p class="card-text"> Категория: <a href="{{route('category.single',['slug'=>$post->category->slug])}}">{{$post->category->title}}</p></a>
                        <p class="card-text">
                            <small class="text-muted">
                                <i class="fas fa-eye"></i> {{$post->views}}
                            </small>
                        </p>

                        <!-- Кнопка лайка и количество лайков -->
                        <div class="d-flex align-items-center mb-3">
                            <p class="card-text mr-3">
                            <div style="padding: 10px;">
                                <i class="fas fa-heart"></i> {{$post->likes->count()}}
                            </div>
                            </p>
                            <div>
                            @if(auth()->check())
                                @if(!$post->likedBy(auth()->user()))
                                    <form action="{{ route('likes.store', $post) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Лайк</button>
                                    </form>
                                @else
                                    <form action="{{ route('likes.destroy', $post) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Удалить лайк</button>
                                    </form>
                                @endif
                            @else
                                <p>Пожалуйста, <a href="{{ route('login') }}">войдите</a> или <a href="{{ route('register') }}">зарегистрируйтесь</a> чтобы ставить лайки.</p>
                            @endif

                        </div>
                        <!-- Конец блока для лайков -->

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Комментарии</h3>
                    </div>
                    <div class="card-body">
                        @if(auth()->check())
                            <form action="{{ route('comments.store', $post) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Оставьте комментарий</label>
                                    @error('body')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <textarea class="form-control" name="body" id="comment" rows="3" required>{{ old('body') }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Отправить</button>
                            </form>
                        @else
                            <p>Пожалуйста, <a href="{{ route('login') }}">войдите</a> или <a href="{{ route('register') }}">зарегистрируйтесь</a> для того, чтобы оставить комментарий.</p>
                        @endif
                        <div class="mt-4">
                            <h4>Комментарии ({{$post->comments->count()}})</h4>
                            @foreach($comments as $comment)
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <h5>@if($comment->user->is_admin)Администратор: @endif{{ $comment->user->name }}</h5>
                                        <p class="mb-0">{{ $comment->body }}</p>
                                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                    @if(Auth::check() && (auth()->user()->is_admin || auth()->id() == $comment->user_id))
                                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этот комментарий?')">Удалить</button>
                                                </form>
                                    @endif
                                    </div>
                                </div>
                            @endforeach
                            {!! $comments->links('pagination::bootstrap-4', ['class' => 'pagination']) !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
