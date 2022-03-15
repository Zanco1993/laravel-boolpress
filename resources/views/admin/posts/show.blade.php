@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header d-flex">
            <a class="btn btn-secondary" href="{{route('admin.posts.index')}}">Annulla</a>

            <p class="ms-auto">{{ $post->title }}</p>

            <a class="ms-auto" href="{{ route('admin.posts.edit', $post->id) }}">Modifica</a>
          </div>

          <div class="card-body">

            <div class="mt-3">
              Contenuto: {{ $post->content }}
                <br>
              Data creazione: {{ $post->created_at }}
              <br>
              Data ultima modifica: {{ $post->updated_at }}
              <br>
              Slug: {{ $post->slug }}
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection