@extends('layout')

@section('content')
<div class="container mt-4">

  <h3>タイトル：{{ $post->title }}
  	<small>投稿日：{{ date("Y年 m月 d日",strtotime($post->created_at)) }}</small>
  </h3>
  <p>カテゴリー：{{ $post->category->name }}</p>
  <p>{{ $post->content }}</p>

  <div class="mb-4 text-right">
    <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post]) }}">
        編集する
    </a>
    <form
      style="display: inline-block;"
      method="POST"
      action="{{ route('posts.destroy', ['post' => $post]) }}"
    >
      {{ csrf_field() }}
      {{ method_field('delete') }}
      <button class="btn btn-danger" onclick="deletePost(this);return false;">
        削除する
      </button>
    </form>
  </div>
  <hr />

  <h4>コメント一覧</h4>
  @foreach($post->comments as $single_comment)
  	<h5>{{ $single_comment->commenter }}</h5>
  	<p>{{ $single_comment->comment }}</p><br />
  @endforeach

  @if(count($post->comments) == 0)
    <p>コメントはありません...</p><br />
  @endif

  <h4>コメントを投稿する</h4>
  {{-- 投稿完了時にフラッシュメッセージを表示 --}}
  @if(Session::has('message'))
	 <div class="bg-info">
	    <p>{{ Session::get('message') }}</p>
	 </div>
  @endif

  {{-- エラーメッセージを表示 --}}
  @if ($errors->any())
  <div class="alert alert-danger">
      <ul style="list-style: none;">
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
  @endif

  <form method="POST" action="{{ route('comments.store') }}">
    {{ csrf_field() }}

    <!-- <fieldset class="mb-4"> -->
    <input
    id="post_id"
    name="post_id"
    type="hidden"
    value="{{ $post->id }}"
    >

      <div class="form-group">
          <label for="commenter">
              名前
          </label>
          <input
              id="commenter"
              name="commenter"
              class="form-control"
              value="{{ old('commenter') }}"
              type="text"
              placeholder="名前を入力して下さい"
          >
      </div>

      <div class="form-group">
          <label for="comment">
              コメント
          </label>
          <textarea
              id="comment"
              name="comment"
              class="form-control"
              rows="3"
              placeholder="コメントを入力して下さい"
          >{{ old('comment') }}</textarea>
      </div>

    	<div class="form-group">
    		<button type="submit" class="btn btn-primary">投稿する</button>
    	</div>
    <!-- </fieldset> -->
  </form>

</div>
@endsection

<script>
  <!-- 削除確認ダイアログ -->
  function deletePost(e) {
    'use strict';

    if (confirm('本当に削除していいですか?')) {
      document.getElementById('form_' + e.dataset.id).submit();
    }
  }
</script>
