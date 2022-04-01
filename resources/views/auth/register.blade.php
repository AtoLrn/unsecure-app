@extends('layouts.app')


@section('content')
  <h1> Connexion </h1>
  <form method="GET" action="{{ route('login.validation') }}">
  @csrf
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Adresse email</label>
      <input type="text" class="form-control" name="email" placeholder="admin@example.com">
    </div>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Mot de passe</label>
      <input type="text" class="form-control" name="email" placeholder="Mot de passe">
    </div>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Nom d'utilisateur</label>
      <input type="password" class="form-control" name="password" placeholder="toto24012">
    </div>
    <input type="hidden" name="createAdmin" value="false" />
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection
