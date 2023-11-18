<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['quantity','status'];


    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

    public function total()
    {
        return $this->quantity * $this->menu->price;
    }

    public function price() {
        return $this->menu ? $this->menu->price : 0;
    }
}
