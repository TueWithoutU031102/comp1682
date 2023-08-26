<?php

namespace App\Models;

use App\Enums\StatusMenu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'image', 'description', 'status'];

    protected $casts = [
        'status' => StatusMenu::class
    ];

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function removeImage()
    {
        if (File::exists(public_path($this->image)))
            return File::delete(public_path($this->image));
    }
}
