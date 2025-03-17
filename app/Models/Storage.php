<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'nvme'];

    public function prices()
    {
        return $this->morphMany(Price::class, 'priceable');
    }
}