<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginCount extends Model
{
    protected $table = 'logincount';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'login_count'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
