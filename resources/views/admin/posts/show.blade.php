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
              <?php
              use Carbon\Carbon;
              ?>
                <br>
                {{-- echo Carbon::now()->diffForHumans(['options' => Carbon::NO_ZERO_DIFF]); // 1 second ago --}}
              Data creazione: {{ $post->created_at->format('d/m/Y H:i') }}
              <br>
              Data ultima modifica: 
              {{ $post->updated_at->diffForHumans(['options' => 0]) }}
              <br>
              {{-- prova con 1 settimana --}}
              Data ultima modifica: {{ $post->updated_at->subweek()->diffForHumans(['options' => Carbon::ONE_DAY_WORDS]) }}
              <br>
              
              Slug: {{ $post->slug }}
              <br>
              {{-- entro nell'istanza di post, nel model l'ho collegata a category, quindi 
              in questa maniera recuperiamo i dati di category --}}

              Il genere del post è: {{ isset($post->category) ? $post->category->name : "Nessuna categoria" }}
              @if ($post->tags !== null)
              <div class="my-3">
                tags:
                @if($post->tag)
                @foreach ($post->tags as $tag)
                  <span class="bg-light">{{ $tag->name }}</span>
                @endforeach
                @else
                  <span>Nessun tag</span>
                @endif
              </div>
            @endif

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection