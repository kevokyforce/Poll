<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $guarded = [];

    use HasFactory;
    
     protected $fillable = [
        'id',
        'poll_id',
        'option_id',
        'user_id',
    ];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
