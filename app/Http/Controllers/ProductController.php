<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    protected $productService;

    // Menghubungkan Controller dengan Service Layer (Refactor)
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Tampilkan Semua Data (Read)
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'status' => true,
            'data' => Product::all()
        ]);
    }

    /**
     * Tambah Data (Create) - Pakai Validasi, Service, & Error Handling
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        try {
            // Validasi otomatis dijalankan lewat StoreProductRequest
            $product = $this->productService->storeProduct($request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan!',
                'data' => $product
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Ubah Data (Update)
     */
    public function update(StoreProductRequest $request, $id): JsonResponse
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);

        $product->update($request->validated());
        return response()->json(['status' => true, 'message' => 'Data berhasil diubah', 'data' => $product]);
    }

    /**
     * Hapus Data (Delete)
     */
    public function destroy($id): JsonResponse
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);

        $product->delete();
        return response()->json(['status' => true, 'message' => 'Data berhasil dihapus']);
    }
}