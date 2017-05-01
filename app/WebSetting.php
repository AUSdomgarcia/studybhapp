<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebSetting extends Model
{
    protected $table = "web_settings";
    protected $fillable = ['key','content','created_at','updated_at'];
}
