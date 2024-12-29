<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    protected $fillable = ['name', 'slug', 'image', 'is_active'];

    // Automatically generate slug when creating or updating the name
    public static function boot()
    {
        parent::boot();

        static::saving(function ($brand) {
            // If slug is not set, generate it from the name
            if (empty($brand->slug)) {
                $brand->slug = Str::slug($brand->name);
            }
        });
    }

    // Define the relationship with the Product model
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
