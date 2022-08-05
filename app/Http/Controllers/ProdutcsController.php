<?php

namespace App\Http\Controllers;

use App\Models\Produtcs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutcsController extends Controller
{
    // get all products
    public function show_all()
    {
        return response()->json([
            'message' => 'Data Product berhasil di ambil',
            'status' => 200,
            'result' => Produtcs::all()
        ], 200);
    }

    // create Products
    public function create_products(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => ['required', 'max:50'],
            'product_type' => ['required', 'in:snack,drink,fruit,cigarette,groceries,make-up'],
            'product_price' => ['required', 'numeric'],
            'expired_at' => ['required', 'date'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages())->setStatusCode(422);
        }
        $payload = $validator->validate();
        Produtcs::create([
            'product_name' => $payload['product_name'],
            'product_type' => $payload['product_type'],
            'product_price' => $payload['product_price'],
            'expired_at' => $payload['expired_at'],
        ]);
        return response()->json([
            'message' => 'Data product berhasil disimpan',
            'status' => 201
        ], 201);
    }

    // get product id
    public function show_id($id)
    {
        if (!Produtcs::find($id)) {
            return response()->json([
                'message' => 'Data dengan product ID:' . $id . ' tidak ditemukan',
            ], 404);
        }
        return response()->json([
            'message' => 'Data product dengan ID: ' . $id,
            'status' => 200,
            'result' => Produtcs::find($id)
        ], 200);
    }

    // get product name
    public function show_name($product_name)
    {
        $product = Produtcs::where('product_name', 'LIKE', '%' . $product_name . '%')->get();
        if ($product->count() > 0) {
            return response()->json([
                'message' => 'Data Product dengan Nama: ' . $product_name,
                'status' => 200,
                'result' => $product,
            ], 200);
        }
        return response()->json([
            'message' => 'Data Product dengan Nama: ' . $product_name . ' tidak ditemukan',
            'status' => 404
        ], 404);
    }

    // update product
    public function update_product(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => ['required', 'max:50'],
            'product_type' => ['required', 'in:snack,drink,fruit,cigarette,groceries,make-up'],
            'product_price' => ['required', 'numeric'],
            'expired_at' => ['required', 'date'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages())->setStatusCode(422);
        }
        $payload = $validator->validate();
        Produtcs::where('id', $id)->update([
            'product_name' => $payload['product_name'],
            'product_type' => $payload['product_type'],
            'product_price' => $payload['product_price'],
            'expired_at' => $payload['expired_at'],
        ]);
        return response()->json([
            'message' => 'Data product berhasil diupdate',
            'status' => 201
        ], 201);
    }

    // delete product
    public function delete_product($id)
    {
        Produtcs::where('id', $id)->delete();
        return response()->json([
            'message' => 'Data product berhasil dihapus',
            'status' => 200
        ], 200);
    }
}
