<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PostsRepository
{
    private static function getLanguageId()
    {
        return Session::get('language_id');
    }

    public static function all()
    {
        return PostTranslation::where('language_id', '=', self::getLanguageId());
    }

    public static function getPost($id)
    {
        return PostTranslation::where('language_id', '=', self::getLanguageId())->where('post_id', '=', $id)->first();
    }

    public static function create(array $postData)
    {
        $post = Post::query()->where('id', '=', $postData['post_id'])->firstOrCreate();

        return PostTranslation::query()
             ->firstOrCreate([
                    'post_id' => $post->id,
                    'language_id' => self::getLanguageId()
                ],[
                    'title' => $postData['title'],
                    'description' => $postData['description'],
                    'content' => $postData['content']
                ]);
    }

    public static function update($id, $postData)
    {
        $post = PostTranslation::query()
            ->where('post_id','=', $id)
            ->where('language_id','=', self::getLanguageId())
            ->first();

        if($post){
            return $post->update($postData);
        } else{
            return false;
        }
    }
    public static function delete($id)
    {
        $post = Post::find($id);
        if($post){
            $postTranslations = PostTranslation::query()
                ->where('post_id', '=', $post->id)
                ->delete();
        }
        return $post ? $post->delete() : false;
    }
}
