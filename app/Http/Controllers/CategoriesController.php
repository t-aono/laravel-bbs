<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class CategoriesController extends Controller
{
    public function showCategory($id)
    {

        $category_posts = Post::where('cat_id', $id)->get();

        return view('posts.category')
          ->with('category_posts', $category_posts);
    }
}
