@extends('layouts.app')

@section('content')
<div class="container">

  <table class="table">
    @foreach ($users as $user)
      <thead class="thead-dark">
        
      <tr>
        <th scope="col">id</th>
        <th scope="col">Name</th>
        <th scope="col">e-mail</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">{{ $user->id }}</th>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        
      </tr>
    </tbody>
  @endforeach
</table>
  
 
</div>
  @endsection