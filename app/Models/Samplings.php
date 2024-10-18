<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Samplings extends Model
{
    use HasFactory;

    protected $fillable = [
        'cycle_id',
        'sampling_no', 
        'date',
        'average_weight'
    ];

    public function cycle(): BelongsTo
    {
        return $this->belongsTo(Cycles::class, 'cycle_id');
    }
}
