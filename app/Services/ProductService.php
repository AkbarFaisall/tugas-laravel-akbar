<?php

namespace App\Services;

use App\Models\Product;
use Exception;

class ProductService
{
    /**
     * Logika untuk menyimpan produk baru.
     */
    public function storeProduct(array $data)
    {
        try {
            // Proses simpan ke database
            return Product::create($data);
        } catch (Exception $e) {
            // Melempar error jika gagal
            throw new Exception("Gagal menyimpan data produk ke database.");
        }
    }
}