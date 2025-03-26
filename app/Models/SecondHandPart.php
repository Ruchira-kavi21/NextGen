<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecondHandPart extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_name',
        'seller_id',
        'price',
        'status',
        'condition',
        'category',
        'description',
        'image1',
        'image2',
        'image3',
        'listing_date',
        'created_at',
        'updated_at',   
    ];
    protected $casts = [
        'listing_date' => 'datetime',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}