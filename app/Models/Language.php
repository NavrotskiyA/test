<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 */
class Language extends Model
{
    use HasFactory;
    protected $table = 'languages';
}
