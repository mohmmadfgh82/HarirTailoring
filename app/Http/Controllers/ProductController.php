<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // نمایش همه محصولات
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    // نمایش یک محصول خاص
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'محصول پیدا نشد'], 404);
        }
        return response()->json($product);
    }

    // افزودن محصول جدید
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return response()->json($product, 201);
    }

    // ویرایش محصول
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'محصول پیدا نشد'], 404);
        }

        $product->update($request->all());

        return response()->json($product);
    }

    // حذف محصول
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'محصول پیدا نشد'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'محصول با موفقیت حذف شد']);
    }
}
