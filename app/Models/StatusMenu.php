<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusMenu extends Model
{
    use HasFactory;
    protected $table = 'statusMenu';
    protected $fillable = ['id', 'name'];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
