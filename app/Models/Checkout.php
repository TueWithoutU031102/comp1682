<?php

namespace App\Models;

use App\Enums\StatusCheckout;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = ['table_id', 'name', 'phone', 'total', 'status'];

    protected $casts = [
        'status' => StatusCheckout::class
    ];

    public function Table()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
