@extends('layouts.app')


@section('content')
  <h1> Hello {{ \Auth::user()->name }}</h1>

  <p> Add a new article </p>
  <form method="POST" action="{{ route('admin.article.add') }}">
  @csrf
    <label>Title :</label>
    <input type="text" name="title" />
    <label>Content :</label>
    <textarea name="content"></textarea>
    <button type="submit">Save my new article</button>
  </form>
@endsection
