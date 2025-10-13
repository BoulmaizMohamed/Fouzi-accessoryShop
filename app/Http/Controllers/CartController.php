<?php


namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Cart $cart)
    {
        return view('cart', [
            'items' => $cart->all(),
            'total' => $cart->total(),
        ]);
    }

    public function add(Request $request, Product $product, Cart $cart)
    {
        $qty = (int) $request->input('qty', 1);
        $cart->add($product, $qty);
        return back()->with('success', 'Item added to cart.');
    }

    public function update(Request $request, Product $product, Cart $cart)
    {
        $qty = (int) $request->input('qty', 1);
        $cart->update($product->id, $qty);
        return back()->with('success', 'Cart updated.');
    }

    public function remove(Product $product, Cart $cart)
    {
        $cart->remove($product->id);
        return back()->with('success', 'Item removed.');
    }

    public function clear(Cart $cart)
    {
        $cart->clear();
        return back()->with('success', 'Cart cleared.');
    }

    public function checkout(Request $request, Cart $cart)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|max:120',
            'email'         => 'nullable|email',
            'phone'         => 'required|string|max:40',
            'address'       => 'required|string|max:255',
            'notes'         => 'nullable|string|max:500',
        ]);

        $items = $cart->all();
        if (empty($items)) {
            return back()->with('error', 'Your cart is empty.');
        }

        // Create order (guest)
        $order = Order::create([
            'customer_name' => $data['customer_name'],
            'email'         => $data['email'] ?? null,
            'phone'         => $data['phone'],
            'address'       => $data['address'],
            'notes'         => $data['notes'] ?? null,
            'total'         => $cart->total(),
            'status'        => 'pending',
        ]);

        foreach ($items as $i) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $i['product_id'],
                'name'       => $i['name'],
                'price'      => $i['price'],
                'qty'        => $i['qty'],
                'subtotal'   => $i['price'] * $i['qty'],
            ]);
        }

        $cart->clear();

        return redirect()->route('cart.index')->with('success', 'Order placed. Thank you!');
    }
}