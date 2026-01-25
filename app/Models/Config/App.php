<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    protected $table = 'conf_app';
    protected $primaryKey = 'app_id';
    protected $guarded = [];
}
