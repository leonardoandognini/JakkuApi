<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\ProductsImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductsImagesController extends Controller
{

    private $productsImages;

    public function __construct(ProductsImages $productsImages){
        $this->productsImages = $productsImages;
    }

    public function setImg($imgId, $productId){
        try {
            $image = $this->productsImages->where('product_id', $productId)->where('is_image', true);

            if($image->count()) $image->first()->update(['is_image' => false]);

            $image = $this->productsImages->find($imgId);
            $image->update(['is_image' => true]);

            return response()->json([
                'data' => [
                    'msg' => 'Imagem principal do produto alterada com sucesso'
                ]
            ], 200);

        }catch (\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    public function delete($imgId){

        try {

            $image = $this->productsImages->find($imgId);
            if($image->is_image){
                $message = new ApiMessages('Não é possivel remover a imagem principal do produto,
                 selecione outra');
                return response()->json($message->getMessage(), 401);
            }

            if($image){
                Storage::disk('public')->delete($image->image);
                $image->delete();
            }

            return response()->json([
                'data' => [
                    'msg' => 'Imagem do produto deletada'
                ]
            ], 200);

        }catch (\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

}
