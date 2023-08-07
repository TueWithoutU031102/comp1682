<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'type_id', 'status_id', 'price', 'image', 'description'];

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
    public function statusMenu()
    {
        return $this->belongsTo(StatusMenu::class, 'status_id');
    }
    public function removeImage()
    {
        if (File::exists(public_path($this->image)))
            return File::delete(public_path($this->image));
    }
}
