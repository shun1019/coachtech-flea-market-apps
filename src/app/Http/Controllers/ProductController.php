<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 商品一覧を表示する
    public function index(Request $request)
    {
        $products = Product::paginate(6);
        return view('products.product_index', compact('products'));
    }

    // 商品登録フォームを表示する
    public function create()
    {
        return view('products.product_register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'season' => 'required|array',
            'season.*' => 'string|in:春,夏,秋,冬',
            'description' => 'required|string|max:1000',
        ]);

        // 画像の保存
        $path = $request->file('image')->store('products', 'public');

        // 商品を保存
        Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'image' => $path,
            'season' => json_encode($validated['season']),
            'description' => $validated['description'],
        ]);

        return redirect()->route('products.index')->with('success', '商品が登録されました。');
    }

    // 商品の詳細を表示する
    public function show(Product $product)
    {
        return view('products.product_detail', compact('product'));
    }

    // 商品編集フォームを表示する
    public function edit(Product $product)
    {
        return view('products.product_edit', compact('product'));
    }

    // 商品を更新する
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'season' => 'required|array',
            'season.*' => 'string|in:春,夏,秋,冬',
            'description' => 'required|string|max:1000',
        ]);

        if ($request->hasFile('image')) {
            // 画像の保存
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->season = json_encode($validated['season']);
        $product->description = $validated['description'];
        $product->save();

        return redirect()->route('products.show', $product->id)->with('success', '商品が更新されました。');
    }

    // 商品を削除する
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', '商品が削除されました。');
    }
}
