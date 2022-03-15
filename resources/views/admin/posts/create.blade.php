@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('admin.posts.store') }}">
        @csrf
        {{-- creo un form che deve ricevere dall'utente, le info da mandare allo store --}}
        <div class="form-group mb-3">
            <label class="mb-3">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Inserisci il titolo">
        </div>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <div class="form-group mb-3">
            <label class="mb-3">Content</label>
            <input type="text" class="form-control @error('content') is-invalid @enderror" name="content" placeholder="Inserisci il contenuto">
        </div>
        @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label>Categoria</label>
            <select name="category_id" class="form-select">
              <option value="">-- nessuna categoria --</option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if (old('category_id')=== $category->id) selected @endIf>
                  {{ $category->name }}</option>
              @endforeach
            </select>
          </div>

        {{-- lo slug sarà una procedura interna eseguita nelle function che conservano le informazioni --}}
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection