<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Bookable;
use App\Models\Booking;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'bookings' => 'required|array|min:1',
            'bookings.*.bookable_id' => 'required|exists:bookables,id',
            'bookings.*.startDate' => 'required|date|after_or_equal:today',
            'bookings.*.endDate' => 'required|date|after_or_equal:bookings.*.startDate',
            'customer.first_names' => 'required|min:2',
            'customer.last_name' => 'required|min:2',
            'customer.street' => 'required|min:3',
            'customer.city' => 'required|min:2',
            'customer.email' => 'required|email',
            'customer.country' => 'required|min:2',
            'customer.state' => 'required|min:2',
            'customer.zip' => 'required|min:2'
        ]);

        $data = array_merge($data, $request->validate([
            'bookings.*' => ['required', function ($attribute, $value, $fail) {
                $bookable = Bookable::findOrFail($value['bookable_id']);

                if (!$bookable->availableFor($value['startDate'], $value['endDate'])) {
                    $fail("The object is not available in given dates!");
                }
            }]
        ]));


        $bookingsData = $data['bookings'];
        $addressData = $data['customer'];

        $bookings = collect($bookingsData)->map(function ($bookingData) use ($addressData) {

            $booking = new Booking();
            $booking->bookable_id = $bookingData['bookable_id'];
            $booking->startDate = $bookingData['startDate'];
            $booking->endDate = $bookingData['endDate'];

            $booking->price = 200;

            $booking->address()->associate(Address::create($addressData));

            $booking->save();

            return $booking;
        });

        return $bookings;
    }
}
