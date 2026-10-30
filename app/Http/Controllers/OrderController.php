<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Fetch orders from the database
        $orders = Order::orderBy('created_at', 'desc')->get();

        // Return the view with the orders data
        return view('admin.orders.index', compact('orders'));
    }
    //Client View of Order Summary
    public function view($id)
    {
        //Get Order from the order table
        $order = Order::findOrFail($id);
        return view('clients.order_summary', compact('order'));
    }
    //Admin View of Order Summary
    public function orderSummary($id)
    {
        //Get Order from the order table
        $order = Order::findOrFail($id);
        return view('admin.orders.summary', compact('order'));
    }
    //Updating Status of the Order
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $order = \App\Models\Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }
}
