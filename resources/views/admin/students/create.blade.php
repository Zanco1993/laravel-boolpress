@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('admin.students.store') }}">


        <div class="form-group mb-3">
            <label class="mb-3">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter name">
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection