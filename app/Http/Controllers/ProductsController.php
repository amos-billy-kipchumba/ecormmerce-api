<?php

namespace App\Http\Controllers;

use App\Models\products;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Brands;
use App\Models\categories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProductsController extends Controller
{
    public function index(Request $request) {

        $bId=$request->query('bId');
        $cId=$request->query('cId');

        $products = products::with(['brand', 'category'])->when($bId, function ($query, $bId) {
            return $query->where('brand_id','=',$bId);
        })
        ->when($cId, function ($query, $cId) {
            return $query->where('category_id','=',$cId);
        })
        ->paginate(6);
        return response()->json($products);
    }

    public function products()
    {
        $products = products::orderBy('created_at','asc')->get();

        return response()->json($products, 200);
    }

    public function show($id) {
        $product = products::find($id);
        if (!$product) {
            return response()->json("Product was not found");
        }
    }

    public function store(Request $request) 
    {
        $request->validate([
            "name" => "required",
            "category_id" => "required",
            "price" => "required|numeric",
            "stock" => "required|integer"
        ]);

        $product = new Products();
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->description = $request->input('description');

        if ($request->hasFile('image')) {
            $path = 'images/';
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
            }

            $file = $request->file('image');
            $filename = Str::random(32) . '.' . $file->getClientOriginalExtension();
            
            try {
                $file->move(public_path($path), $filename);
                $product->image = $filename;
            } catch (\Exception $e) {
                return response()->json(['message' => 'Error uploading image'], 500);
            }
        }

        $product->save();
        return response()->json(["message" => "Product added successfully", "data" => $product], 201);
    }

    public function update($id, Request $request) 
    {
        $request->validate([
            "name" => "required",
            "category_id" => "required",
            "price" => "required|numeric",
            "stock" => "required|integer",
        ]);

        $product = Products::findOrFail($id);
        
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->description = $request->input('description');

        if ($request->hasFile('image')) {
            $path = 'images/';
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
            }

            // Delete old image if exists
            if ($product->image && File::exists(public_path($product->image))) {
                File::delete(public_path($product->image));
            }

            $file = $request->file('image');
            $filename = Str::random(32) . '.' . $file->getClientOriginalExtension();
            
            try {
                $file->move(public_path($path), $filename);
                $product->image = $filename;
            } catch (\Exception $e) {
                return response()->json(['message' => 'Error uploading image'], 500);
            }
        }

        $product->save();
        return response()->json(["message" => "Product updated successfully", "data" => $product], 200);
    }

    public function delete($id)
    {
        try {
            $product = Products::findOrFail($id);
            
            // Delete associated image if exists
            if ($product->image && File::exists(public_path($product->image))) {
                File::delete(public_path($product->image));
            }

            $product->delete();
            return response()->json(['message' => 'Product deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting product: ' . $e->getMessage()], 400);
        }
    }

    public function search(Request $request)
    {
        $searchTerm = $request->query('searchTerm');

        $products = Products::with(['brand', 'category'])
            ->where('name', 'LIKE', '%' . $searchTerm . '%')
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($products);
    }
}
