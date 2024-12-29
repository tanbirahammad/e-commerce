<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    // Allow these fields to be mass-assigned
    protected $fillable = ['name', 'slug', 'image', 'is_active'];

    // Relationship with Product
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Automatically generate slug before saving
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($category) {
            // If slug is empty, generate it from the name
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }
}
