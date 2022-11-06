<?php

namespace App\Models;

use App\Traits\HasCompositePrimaryKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $post_id
 * @property $language_id
 * @property $title
 * @property $description
 * @property $content
 */

class PostTranslation extends Model
{
    use HasFactory;
    use HasCompositePrimaryKeyTrait;

    protected $primaryKey = ['post_id','language_id'];

    public $incrementing = false;

    protected $guarded = [];

    public function tags(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(Tag::class, Post::class);
    }

}
