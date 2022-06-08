<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bookable;
use Illuminate\Http\Request;

class BookableAvailabilityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, Request $request)
    {

        $data = $request->validate([
            'startDate' => 'required|date_format:Y-m-d|after_or_equal:now',
            'endDate' => 'required|date_format:Y-m-d|after_or_equal:startDate',
        ]);

        $bookable = Bookable::findOrFail($id);

        dd($bookable->bookings()->betweenDates($data['startDate'], $data['endDate'])->count());
    }
}
