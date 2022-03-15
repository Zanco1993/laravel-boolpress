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

                <a class="btn btn-warning ms-auto" href="{{ route('admin.posts.show', $post->id) }}">Dettagli</a>
                <div class="px-2">
                  <form method="POST" action="{{ route('admin.posts.destroy', $post->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Elimina</button>
                  </form>
                </div>
              </li>
              
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
