<?php

namespace App\Models;

use App\Enums\foodQuality;
use App\Enums\serviceQuality;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'phone', 'email', 'detail'];
    protected $casts = [
        'foodQuality' => foodQuality::class,
        'serviceQuality'=>serviceQuality::class,
    ];
}
