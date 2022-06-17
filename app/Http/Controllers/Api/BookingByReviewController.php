<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingByReviewShowResource;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingByReviewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param $reviewKey
     * @param \Illuminate\Http\Request $request
     * @return Booking|never
     */
    public function __invoke($reviewKey, Request $request)
    {
        return  new BookingByReviewShowResource(Booking::findByReviewKey($reviewKey)) ?? abort(404);
    }
}
