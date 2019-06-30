@extends('layout')

@section('content')
<div class="container mt-4">

@foreach($category_posts as $category_post)

	<h3>タイトル：{{ $category_post->title }}
    <small>投稿日：{{ date("Y年 m月 d日",strtotime($category_post->created_at)) }}</small>
  </h3>
	<p>カテゴリー：{{ $category_post->category->name }}</p>
	<p>{{ $category_post->content }}</p>
  <a class="btn btn-info" href="{{ route('posts.show', ['post' => $category_post->id]) }}">
      続きを読む
  </a>
  <p>コメント数：{{ $category_post->comment_count }}</p>
  <hr />

@endforeach

</div>
@endsection
