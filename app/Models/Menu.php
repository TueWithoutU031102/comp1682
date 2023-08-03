<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'type_id', 'price', 'image', 'description'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function removeImage()
    {
        if (File::exists(public_path($this->image))) return File::delete(public_path($this->image));
    }
}
