<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Link;
use App\Models\Category;
use App\Models\Favorite;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_url',
        'category_id',
        'slug',       
    ];
    //SCOPE
    public function scopeWithLinks($query)
    {
        return $query->has('links');
    }
    /**
     * Get the links for the product.
     */
    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')
        ->withDefault(1);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
