<?php


namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Arr;

class Cart
{
    protected string $key = 'cart.items';

    public function all(): array
    {
        return session($this->key, []);
    }

    public function add(Product $product, int $qty = 1): void
    {
        $items = $this->all();

        $image = $product->main_image
            ?: (is_array($product->images ?? null) && count($product->images) ? $product->images[0] : null);

        if (isset($items[$product->id])) {
            $items[$product->id]['qty'] += $qty;
        } else {
            $items[$product->id] = [
                'product_id' => $product->id,
                'name'       => $product->name,
                'price'      => (float) $product->price,
                'image'      => $image, // storage relative path
                'qty'        => max(1, $qty),
            ];
        }

        session([$this->key => $items]);
    }

    public function update(int $productId, int $qty): void
    {
        $items = $this->all();
        if (isset($items[$productId])) {
            $items[$productId]['qty'] = max(1, $qty);
            session([$this->key => $items]);
        }
    }

    public function remove(int $productId): void
    {
        $items = $this->all();
        unset($items[$productId]);
        session([$this->key => $items]);
    }

    public function clear(): void
    {
        session()->forget($this->key);
    }

    public function count(): int
    {
        return array_sum(Arr::pluck($this->all(), 'qty'));
    }

    public function total(): float
    {
        return array_sum(array_map(fn ($i) => $i['price'] * $i['qty'], $this->all()));
    }
}