@extends('layout')

@section('content')
<div class="container mt-4">
  <div class="border p-4">
    <h1 class="h5 mb-4">
      投稿を作成
    </h1>

    {{-- 投稿完了時にフラッシュメッセージを表示 --}}
    @if(Session::has('message'))
    	<div class="bg-info">
    		<p>{{ session('message') }}</p>
    	</div>
    @endif

    {{-- エラーメッセージの表示 --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul style="list-style: none;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('posts.store') }}">
      {{ csrf_field() }}

      <fieldset class="mb-4">
        <div class="form-group">
            <label for="title">
                タイトル
            </label>
            <input
                id="title"
                name="title"
                class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                value="{{ old('title') }}"
                type="text"
                placeholder="タイトルを入力して下さい"
            >
        </div>

        <div class="form-group">
          <label for="cat_id" class="">カテゴリー</label>
          <div class="">
            <select name="cat_id" type="text" class="">
              <option></option>
              <option value="1" name="1">電化製品</option>
              <option value="2" name="2">食品</option>
              <option value="3" name="3">雑貨</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="content">
              本文
          </label>

          <textarea
              id="content"
              name="content"
              class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}"
              rows="4"
              placeholder="本文を入力して下さい"
          >{{ old('content') }}</textarea>
        </div>

        <div class="mt-5">
            <button type="submit" class="btn btn-primary">
                投稿する
            </button>
            <a class="btn btn-secondary" href="{{ route('top') }}">
              戻る
            </a>
        </div>
      </fieldset>
    </form>
  </div>
</div>
@endsection
