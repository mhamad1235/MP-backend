<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sso extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'provider', 'provider_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
