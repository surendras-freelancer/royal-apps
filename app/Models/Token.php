<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
    protected $fillable = [
        'token',
        'user_id'
    ];

    public function getUserID()
    {
        $tokens = Token::first();
        if(isset($tokens)){
            return $tokens->user_id;
        }else{
            return null;
        }
    }
}
