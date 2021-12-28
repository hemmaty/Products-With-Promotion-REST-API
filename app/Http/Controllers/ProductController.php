<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\ProductResource;
use App\Traits\Pagination\PaginationHelper;
use App\Traits\Product\ProductSearchHelper;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    use PaginationHelper;
    use ProductSearchHelper;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function products(Request $request){
        $this->validate($request,$this->getProductSearchRules());
        $products=$this->getProductsWithFilter($request);
        return response()->success([
            'products'=>ProductResource::collection($products),
            'pagination'=>$this->getPaginationAsArray($products),
        ]);
    }

}
