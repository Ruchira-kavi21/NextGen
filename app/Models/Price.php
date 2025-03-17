<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = ['price', 'purchase_url', 'retailer_id', 'priceable_id', 'priceable_type'];

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }

    public function priceable()
    {
        return $this->morphTo();
    }
}