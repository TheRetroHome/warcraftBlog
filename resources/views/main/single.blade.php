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
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Комментарии</h3>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Оставьте комментарий</label>
                                <textarea class="form-control" id="comment" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
