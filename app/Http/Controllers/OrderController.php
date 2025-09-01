<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    // نمایش لیست سفارشات
    public function index()
    {
        $orders = Order::with('product')->get();
        return response()->json($orders);
    }

    // نمایش یک سفارش خاص
    public function show($id)
    {
        $order = Order::with('product')->find($id);
        if (!$order) {
            return response()->json(['message' => 'سفارش پیدا نشد'], 404);
        }
        return response()->json($order);
    }

    // ایجاد سفارش جدید
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);
        $totalPrice = $product->price * $request->quantity;

        $order = Order::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
        ]);

        return response()->json($order, 201);
    }
}
