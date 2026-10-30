<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('clients.cart', compact('cart'));
    }
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $variantId = $request->input('variant');

        // Create a unique cart key for this product + variant combination
        $cartKey = $id . '-' . $variantId;

        $cart = session()->get('cart', []);

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity']++;
        } else {
            $cart[$cartKey] = [
                "product_id" => $id,
                "variant_id" => $variantId,
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => 1,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    //Reset Cart
    public function reset()
    {
        session()->forget('cart');

        return redirect()->back()->with('success', 'Cart has been cleared!');
    }
    //Check out method
    public function checkout()
    {
        $cart = session()->get('cart', []);

        // Redirect back to cart if it's empty
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $user = Auth::user();

        return view('clients.checkout', compact('cart', 'user'));
    }
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:50',
        ]);

        // Calculate total amount
        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        // Generate a mock transaction ID
        $transactionId = 'TXN-' . strtoupper(uniqid());

        // Create order using Eloquent
        $order = Order::create([
            'user_id' => Auth::id(),
            'transaction_id' => $transactionId,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'total_amount' => $totalAmount,
            'status' => 'Paid',
        ]);

        // Create order items using Eloquent
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_variant_id' => $item['variant_id'],
                'price' => $item['price'],
            ]);
        }
        //Send the email to the customer
        Mail::to($order->user->email)->send(new OrderConfirmationMail($order));
        // Clear the cart session
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Order placed successfully! Transaction ID: ' . $transactionId);
    }
}
