<?php

namespace App\Http\Controllers\Api;

use App\Products;
use http\Client\Curl\User;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{

    private $products;

    public function __construct(Products $products){
        $this->products = $products;
    }


    public function index(){
        $products = $this->products->paginate('10');
        return response()->json($products, 200);
    }

    public function store(Request $request){

        $data = $request->all();

        try {

            $product = $this->products->create($data);

            return response()->json([
                'data' => [
                    'msg' => 'Produto cadastrado com sucesso'
                ]
            ], 200);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 401);
        }

    }


}
