@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header d-flex">
            Lista dei post

            <a class="ms-auto" href="{{ route('admin.posts.create') }}">Aggiungi...</a>
          </div>

          <div class="card-body">
            <ul class="list-group">
              @foreach ($posts as $post)
              <li class="list-group-item d-flex align-items-center">
                <div>
                  {{ $post->title }}
                </div>

                <a class="ms-auto" href="{{ route('admin.posts.show', $post->id) }}">Dettagli</a>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
