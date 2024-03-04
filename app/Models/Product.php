<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->created_by = auth()->id();
        });
    }

    use HasFactory;

    protected $fillable = [
        'category_id',
        'created_by',
        'name',
        'description',
        'sku',
        'barcode',
        'brand',
        'model',
        'unit',
        'price',
        'quantity',
        'alert_quantity',
        'image',
        'status',
        'is_expirable',
        'expires_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
