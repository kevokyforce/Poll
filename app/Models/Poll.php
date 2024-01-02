<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\PollStatus;

class Poll extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'status' => PollStatus::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function getStartDateAttribute()
    {
        return $this->start_at->format('M d, Y');
    }

    public function getStartTimeAttribute()
    {
        return $this->start_at->format('h:i A');
    }

    public function getEndDateAttribute()
    {
        return $this->end_at->format('M d, Y');
    }

    public function getEndTimeAttribute()
    {
        return $this->end_at->format('h:i A');
    }

    public function getEndDateFormatAttribute()
    {
        return $this->end_at->diffForHumans();
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
    

}
