<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cycles extends Model
{
    use HasFactory;

    protected $fillable = [
        'cycle_no',
        'start_date', 
        'end_date',
        'status',
        'description'
    ];

    public function samplings(): HasMany
    {
        return $this->hasMany(Samplings::class, 'cycle_id');
    }
    
    public function shrimp(): HasOne
    {
        return $this->hasOne(Shrimps::class, 'cycle_id');
    }

    public function harvest(): HasOne
    {
        return $this->hasOne(Harvests::class, 'cycle_id');
    }

    // public function sensors(): HasMany
    // {
    //     return $this->hasMany(SensorDatas::class);
    // }
}
