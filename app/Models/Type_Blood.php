<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Type_Blood extends Model
{
    use HasTranslations;

    public $translatable = ['Name'];

    protected $fillable=['Name'];
}
