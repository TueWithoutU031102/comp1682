<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $table = 'tables';
    protected $fillable = ['name'];
    protected function link(): Attribute
    {
        return Attribute::make(
            get: fn()=>"customers/checkins/tables/".$this->id
        );
    }
}
