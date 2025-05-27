<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model

{
    use SoftDeletes;
    
    protected $table = 'tasks';
    protected $fillable = ['title','status','content','user_id'];

    public function user(){
        return $this->hasMany(User::class);
    }
}
