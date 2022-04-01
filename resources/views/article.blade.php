@extends('layouts.app')


@section('content')
  <h1> <?php echo $article->title ?> </h1>

  <p> <?php echo $article->content ?></p>


  <h4>Derniers commentaire :</h4>

  @foreach($article->comments as $comment)
  <div>
    <?php echo $comment->author ?> à dit :
    <p><?php echo $comment->message ?></p>
  </div>
  @endforeach


  <form method="POST" action="{{ route('article.add.comment') }}" >
  @csrf
    <p>Author name : </p><input type="text" name="author" />
    <p>Message : </p><textarea name="message"></textarea>
    <input type="hidden" name="article_id" value="{{ $article->id }}">
    <br>
    <button type="submit">Send my comment !</button>
  </form>


@endsection
