<?php

namespace App\Http\Controllers;

use App\BigcommerceClient;
use Illuminate\Http\Request;

class BigcommerceController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new BigcommerceClient();
    }

    public function pushProduct()
    {
        $product = [
            "name" => "Plain T-Shirt",
            "type" => "physical",
            "description" => "This timeless fashion staple will never go out of style!",
            "price" => "29.99",
            "categories" => [18],
            "availability" => "available",
            "weight" => "0.5"
        ];

        $result = $this->client->call('POST', 'products', ['json' => $product])->decode();
        return response()->json($result);
    }

    public function getProducts()
    {
        $products = $this->client->call('GET', 'products')->decode();
        return response()->json($products);
    }
}
