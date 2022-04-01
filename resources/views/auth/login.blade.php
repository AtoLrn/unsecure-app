@extends('layouts.app')


@section('content')
  <h1> Connexion </h1>
  <form method="POST" action="{{ route('login.validation') }}">
  @csrf
    @error('login')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Nom d'utilisateur</label>
      <input type="text" class="form-control" name="username" placeholder="toto" autocomplete="off">
    </div>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Mot de passe</label>
      <input type="password" class="form-control" name="password" placeholder="Mot de passe" autocomplete="off">
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>

  </form>
@endsection
