<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  // create()やupdate()で入力を受け付ける ホワイトリスト
  protected $fillable = ['commenter', 'comment', 'post_id'];

}
