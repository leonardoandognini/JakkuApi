<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Requests\ProductsRequest;
use App\Products;
use http\Client\Curl\User;
use http\Env\Response;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{

    private $products;

    public function __construct(Products $products){
        $this->products = $products;
    }


    public function index(){
        $products = auth('api')->user()->products();

       // $products = $this->products->paginate('10');
        return response()->json($products->paginate(10), 200);
    }


    public function show($id){

        try {

            $product = auth('api')->user()->products()->with('images')->findOrFail($id);


            return response()->json([
                'data' => [
                    'msg' => 'Produto al terado com sucesso',
                    'data' => $product
                ]
            ], 200);
        }catch (\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }

    }


    public function store(ProductsRequest $request){

        $data = $request->all();
        $images = $request->file('images');
        try {
            $data['user_id'] = auth('api')->user()->id;

            $product = $this->products->create($data);

            if (isset($data['categories']) && count($data['categories'])) {
                $product->categories()->sync($data['categories']);
            }

            if($images){
                $imagesUploaded = [];
                foreach ($images as $image){
                   $path = $image->store('images', 'public');
                   $imagesUploaded[] = ['image' => $path, 'is_image' => false];
                }
                $product->images()->createMany($imagesUploaded);

            }


            return response()->json([
                'data' => [
                    'msg' => 'Produto cadastrado com sucesso'
                ]
            ], 200);
        }catch (\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }

    }

    public function update($id, ProductsRequest $request){

        $data = $request->all();
        $images = $request->file('images');

        try {

            $product = auth('api')->user()->products->findOrFail($id);
            $product->update($data);

            if (isset($data['categories']) && count($data['categories'])) {
                $product->categories()->sync($data['categories']);
            }

            if($images){
                $imagesUploaded = [];
                foreach ($images as $image){
                    $path = $image->store('images', 'public');
                    $imagesUploaded[] = ['image' => $path, 'is_image' => false];
                }

                $product->images()->createMany($imagesUploaded);

            }

            return response()->json([
                'data' => [
                    'msg' => 'Produto alterado com sucesso'
                ]
            ], 200);
        }catch (\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }

    }


    public function destroy($id){

        try {

            $product = auth('api')->user()->products->findOrFail($id);
            $product->delete();

            return response()->json([
                'data' => [
                    'msg' => 'Produto excluido'
                ]
            ], 200);
        }catch (\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }

    }


}
