<?php

namespace App\Http\Controllers\Customer;

use App\Enums\foodQuality;
use App\Enums\serviceQuality;
use Illuminate\Validation\Rules\Enum;
use App\Models\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends CustomerController
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $foodQuality = foodQuality::cases();
        $serviceQuality = serviceQuality::cases();
        return view("customer.review.create", ['foodQuality' => $foodQuality, 'serviceQuality' => $serviceQuality]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Review $review)
    {
        //
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required|required|digits:10|starts_with:0',
            'email' => 'required|email',
            'foodQuality' => ['required', new Enum(foodQuality::class)],
            'serviceQuality' => ['required', new Enum(serviceQuality::class)],
            'detail' => 'required',
        ]);

        $review->fill($data)->save();

        return to_route('customer.index')->with('success', 'Review successfully recorded');
    }
}
