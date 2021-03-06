<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    protected $fillable = ['id', 'content', 'rating'];

    public function getIncrementing()
    {
        return false;
    }

    public function bookable()
    {
        return $this->belongsTo(Bookable::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

//    public function getKeyType(): string
//    {
//        return $this->keyType;
//    }

}
