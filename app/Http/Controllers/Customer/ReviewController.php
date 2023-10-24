<?php

namespace App\Http\Controllers\Customer;

use App\Enums\foodQuality;
use App\Enums\serviceQuality;
use App\Models\Review;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;

class ReviewController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $foodQuality = foodQuality::cases();
        $serviceQuality = serviceQuality::cases();
        return view("customer.review.create", ['foodQuality' => $foodQuality, 'serviceQuality' => $serviceQuality]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        //
    }
}
