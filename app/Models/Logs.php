<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $table = 'log';
    protected $fillable = ['content','team_id'];
}
