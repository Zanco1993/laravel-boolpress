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
                  <p>Il creatore del contenuto è: {{ $post->user->name }}</p>
                  <p>Il titolo del post è: {{ $post->title }}</p>

                    <div>
                      {{-- se esiste la variabile $post->category allora mostra il suo valore altrimenti scrivi Nessuna categoria --}}
                      Il genere del post è: {{ isset($post->category) ? $post->category->name : "Nessuna categoria" }}
                    </div>
                    <br>
                    <div>
                      {{-- se esiste la variabile $post->tag allora mostra il suo valore altrimenti scrivi Nessun tag --}}
                      Il tag del post è: {{ isset($post->tag) ? $post->tag->name : "Nessun tag" }}
                    </div>


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
