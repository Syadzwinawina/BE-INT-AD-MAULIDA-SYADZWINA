<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProdukController extends Controller
{
    // // Ambil semua produk
    // public function index() {
    //     return Produk::all();
    // }

    // // Tambah produk baru
    // public function store(Request $request) {
    //     $validatedData = $request->validate([
    //         'nama' => 'required',
    //         'date' => 'required|date',
    //         'Jumlah' => 'required|numeric',
    //         'harga' => 'required|numeric',
    //         'images' => 'nullable|json',
    //         'id_user' => 'required|exists:users,id', // Harus valid dengan tabel users
    //     ]);

    //     return Produk::create($validatedData);
    // }

    // // Ambil produk berdasarkan ID
    // public function show($id) {
    //     return Produk::findOrFail($id);
    // }

    // // Update produk
    // public function update(Request $request, $id) {
    //     $produk = Produk::findOrFail($id);
    //     $produk->update($request->all());
    //     return $produk;
    // }

    // // Hapus produk
    // public function destroy($id) {
    //     Produk::destroy($id);
    //     return response()->json(['message' => 'Produk deleted successfully']);
    // }


    // public function order(Request $request) {
    //     $validatedData = $request->validate([
    //         'product_id' => 'required|exists:produk,id',
    //         'quantity' => 'required|numeric',
    //         'total_price' => 'required|numeric',
    //         'name' => 'required|string',
    //     ]);
    
    //     // Simpan pesanan ke database
    //     $order = Order::create([
    //         'product_id' => $validatedData['product_id'],
    //         'quantity' => $validatedData['quantity'],
    //         'total_price' => $validatedData['total_price'],
    //         'name' => $validatedData['name'],
    //     ]);
    
    //     return response()->json(['message' => 'Pesanan berhasil dikirim.', 'order' => $order], 201);
    // }


    public function store(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'product_id' => 'required|integer',
                'quantity' => 'required|integer|min:1',
                'total_price' => 'required|numeric',
                'name' => 'required|string|max:255',
            ]);
    
            // Simpan pesanan ke database
            $order = Order::create([
                'product_id' => $validatedData['product_id'],
                'quantity' => $validatedData['quantity'],
                'total_price' => $validatedData['total_price'],
                'customer_name' => $validatedData['name'],
            ]);
    
            return response()->json(['order' => $order, 'message' => 'Order successful'], 201);
        } catch (\Exception $e) {
            // Log the exception message
            \Log::error('Order store error: ' . $e->getMessage());
    
            // Return a generic error message
            return response()->json(['message' => 'Terjadi kesalahan saat memproses pesanan.'], 500);
        }
    }
}    