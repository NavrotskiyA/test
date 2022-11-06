<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Session;

class TagsRepository
{
    private static function getLanguageId()
    {
        return Session::get('language_id');
    }

    public static function all()
    {
        return Tag::where('language_id', '=', self::getLanguageId());
    }

    public static function getTag($id)
    {
        return Tag::where('id', '=', $id)->first();
    }

    public static function create($tagData)
    {
        return Post::find($tagData['post_id'])->tags()->firstOrCreate([
            'name' => $tagData['name'],
            'language_id' => self::getLanguageId()
        ]);
    }

    public static function update($id, $tagData)
    {
        $tag = Tag::query()
            ->where('id','=', $id)
            ->first();
        if($tag){
            return $tag->update($tagData);
        } else{
            return false;
        }
    }

    public static function delete(int $id)
    {
        $tag = Tag::query()
            ->where('id','=', $id)
            ->delete();
        return $tag;
    }

}
