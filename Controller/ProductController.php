<?php

namespace Controller;

include "Traits/ApiResponseFormatter.php";
include "Models/Product.php";

use Models\Product;
use Traits\ApiResponseFormatter;

class ProductController
{
    // Memakai TRAIT yang sudah dibuat
    use ApiResponseFormatter;

    public function index()
    {
        // Define object model product yang ssudah dibuat
        $productModel = new Product();
        // panggil fungsi get all product
        $response = $productModel->findAll();
        // return $response dengan melakukan formating terlebih dahulu menggunakan trait yang ssudah dipanggil
        return $this->apiResponse(200, "success", $response);
    }

    public function getById($id)
    {
        $productModel = new Product();
        $response = $productModel->findById($id);
        return $this->apiResponse(200, "success", $response);
    }

    public function insert()
    {
        // tangkapan input json
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);
        // validasi inputan valid
        if (json_last_error()) {
            return $this->apiResponse(400, "error invalid input", null);
        }

        // lanjut jika tidak error
        $productModel = new Product();
        $response = $productModel->create([
            "product_name" => $inputData['product_name']
        ]);

        return $this->apiResponse(200, "success", $response);
    }

    public function update($id)
    {
        // tangkap input json
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);
        // validasi inputan valid
        if (json_last_error()) {
            return $this->apiResponse(400, "error invalid input", null);
        }

        // lanjut jika tidak error
        $productModel = new Product();
        $response = $productModel->update([
            "product_name" => $inputData['product_name']
        ], $id);

        return $this->apiResponse(200, "success", $response);
    }

    public function delete($id)
    {
        $productModel = new Product();
        $response = $productModel->destroy($id);

        return $this->apiResponse(200, "success", $response);
    }
}
