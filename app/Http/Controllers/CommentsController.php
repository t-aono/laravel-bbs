<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
      $params = $request->validate([
        'commenter' => 'required',
        'comment'=>'required',
        'post_id'=>'required',
      ], [
        'commenter.required' => 'タイトルを正しく入力してください。',
        'comment.required' => '本文を正しく入力してください。',
      ]);
      $post = Post::findOrFail($params['post_id']);
      $post->comments()->create($params);

      return redirect()->route('posts.show', ['post' => $post]);

    }
}
