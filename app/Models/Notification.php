<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    protected $fillable = ['session_id'];

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }
}
