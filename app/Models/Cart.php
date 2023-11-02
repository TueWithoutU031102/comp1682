<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['quantity','status'];


    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }
}
