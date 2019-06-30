@extends('layout')

@section('content')
<div class="container mt-4">

  <div class="mb-4 text-right">
    <a href="{{ route('posts.create') }}" class="btn btn-primary">
      投稿を新規作成
    </a>
  </div>

  @foreach($posts as $post)

  	<h2>タイトル：{{ $post->title }}
  		<small>投稿日：{{ date("Y年 m月 d日",strtotime($post->created_at)) }}</small>
  	</h2>
    <p>カテゴリー：
      <a href="{{ url('/category', $post->category->id) }}">
        {{ $post->category->name }}
      </a>
    </p>
  	<p>{{ $post->content }}</p>
    <a class="btn btn-secondary" href="{{ route('posts.show', ['post' => $post]) }}">
        続きを読む
    </a>
    <p>コメント数：{{ $post->comment_count }}</p>
  	<hr />
  @endforeach

  <div class="d-flex justify-content-center">
    {{ $posts->links() }}
  </div>

</div>

@endsection
