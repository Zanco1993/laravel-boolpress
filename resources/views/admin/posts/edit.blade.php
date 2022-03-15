@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('admin.posts.update', $post->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label class="mb-3">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $post->title) }}" placeholder="Inserisci il titolo">
        </div>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <div class="form-group mb-3">
            <label class="mb-3">Content</label>
            <input type="text" class="form-control @error('content') is-invalid @enderror" name="content" value="{{ old('content', $post->content) }}" placeholder="Inserisci il contenuto">
            
        </div>

        @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        
        <button type="submit" class="btn btn-warning">Clicca per modificare</button>
    </form>
</div>

@endsection