<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bookable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookablePriceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke($id, Request $request)
    {
        $bookable = Bookable::findOrFail($id);

        $data = $request->validate([
            'startDate' => 'required|date_format:Y-m-d',
            'endDate' => 'required|date_format:Y-m-d|after_or_equal:startDate'
        ]);

        return response()->json([
            'data' => $bookable->priceFor($data['startDate'], $data['endDate'])
        ]);
    }
}
