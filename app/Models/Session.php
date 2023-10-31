<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $table = 'sessions';
    protected $fillable = ['table_id', 'name', 'phone'];
    public function Table()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }
}
