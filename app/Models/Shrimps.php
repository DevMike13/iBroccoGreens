<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shrimps extends Model
{
    use HasFactory;

    protected $fillable = [
        'cycle_id',
        'shrimp_count'
    ];

    public function cycle(): BelongsTo
    {
        return $this->belongsTo(Cycles::class, 'cycle_id');
    }
}
