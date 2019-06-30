<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);

        return view('posts.index', ['posts' => $posts]);
    }


    public function show($post_id)
    {
        $post = Post::findOrFail($post_id);

        return view('posts.show', [
              'post' => $post,
          ]);
    }


    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {
        $params = $request->validate([
          'title' => 'required',
          'cat_id' => 'required',
          'content' => 'required',
        ], [
          'title.required' => 'タイトルを正しく入力して下さい。',
          'cat_id.required' => 'カテゴリーを選択して下さい。',
          'content.required' => '本文を正しく入力して下さい。',
        ]);

        Post::create($params);

        // $request->session()->flash('message', '投稿が完了しました。');
        return back()->with('message', '投稿が完了しました。');
    }


    public function edit($post_id)
    {
        $post = Post::findOrFail($post_id);

        return view('posts.edit', [
        'post' => $post,
      ]);
    }


    public function update($post_id, Request $request)
    {
        $params = $request->validate([
          'title' => 'required',
          'cat_id' => 'required',
          'content' => 'required',
        ], [
          'title.required' => 'タイトルを正しく入力して下さい。',
          'cat_id.required' => 'カテゴリーを選択して下さい。',
          'content.required' => '本文を正しく入力して下さい。',
        ]);

        $post = Post::findOrFail($post_id);
        $post->fill($params)->save();

        return redirect()->route('posts.show', [
        'post' => $post_id
      ]);
    }


    public function destroy($post_id)
    {
        $post = Post::findOrFail($post_id);

        \DB::transaction(function () use ($post) {
            $post->comments()->delete();
            $post->delete();
        });

        return redirect()->route('top');
    }
}
