<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookable extends Model
{
    use HasFactory;

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function availableFor($startDate, $endDate): bool
    {
        return 0 === $this->bookings()->betweenDates($startDate, $endDate)->count();
    }

    public function pricefor($startName, $endDate): array
    {
        $days = (new Carbon($startName))->diffInDays(new Carbon($endDate)) + 1;
        $price = $days * $this->price;

        return [
            'total' => $price,
            'breakdown' => [
                $this->price => $days
            ]
        ];
    }

}
