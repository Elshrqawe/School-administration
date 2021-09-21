<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Grade;
class FundAccount extends Model
{

    protected $table = 'fund_accounts';
    public $timestamps = true;
    protected $guarded= [];


}
