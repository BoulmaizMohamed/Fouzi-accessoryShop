<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property int|null $category_id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property float $price
 * @property int $stock
 * @property array|null $images
 * @property bool $active
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'slug', 'description',
        'price', 'stock','main_image' , 'images', 'active'
    ];

    protected $casts = [
        'images' => 'array',
        'price' => 'decimal:2',
        'active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /*public function images()
    {
        return $this->hasMany(ProductImage::class);
    }*/

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
