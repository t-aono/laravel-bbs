<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Comment;
use App\Category;


class PostCommentSeeder extends Seeder
{
    public function run()
    {
        $content = 'この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。';

        $commentdammy = 'コメントダミーです。ダミーコメントだよ。';

        for ($i = 1 ; $i <= 10 ; $i++) {

            $maxComments = mt_rand(1, 9);

            for ($j=0; $j < $maxComments; $j++) {
                DB::table('comments')->insert([
                  [
                  'commenter' => '名無しさん',
                  'comment' => $commentdammy,
                  'post_id' => $i,
                  'created_at' => date('Y-m-d H:i:s'),
                  ],
                ]);
            }

            DB::table('posts')->insert([
              [
              'title' => $i. '番目の投稿',
              'content' => $content,
              'cat_id' => mt_rand(1,3),
              'comment_count' => $maxComments,
              'created_at' => date('Y-m-d H:i:s'),
              ],
            ]);
            sleep(1);
        }

        // カテゴリーを追加する
        $cat1 = new Category;
        $cat1->id = 1;
        $cat1->name = "電化製品";
        $cat1->save();

        $cat2 = new Category;
        $cat2->id = 2;
        $cat2->name = "食品";
        $cat2->save();

        $cat3 = new Category;
        $cat3->id = 3;
        $cat3->name = "雑貨";
        $cat3->save();
    }
}
