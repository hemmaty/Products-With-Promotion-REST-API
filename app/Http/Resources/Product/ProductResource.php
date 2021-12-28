<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'sku'=>$this->sku,
            'name'=>$this->name,
            'category'=>$this->category_name,
            'price'=>[
                'original'=>$this->actual_price,
                'final'=>$this->final_price,
                'discount_percentage'=>$this->discount_percentage_text,
                'currency'=>$this->currency_code,
            ],
        ];
    }
}










































