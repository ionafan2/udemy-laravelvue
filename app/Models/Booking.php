<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['startDate', 'endDate'];

    public function bookable()
    {
        return $this->belongsTo(Bookable::class);
    }
}
