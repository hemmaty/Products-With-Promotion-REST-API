<?php
namespace App\Traits\Product;


use App\Models\Product;
use Illuminate\Http\Request;

trait ProductSearchHelper
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    protected function getProductsWithFilter(Request $request){
        $category=$request->get('category',false);
        $less_price=$request->get('priceLessThan',false);
        $model=Product::query();
        if($category){
            $model=$model->whereHas('categories', function ($query) use ($category) {
                $query->where('name', $category);
            });
        }
        if($less_price){
            $model=$model->where('actual_price','<=',$less_price);
        }
        return $model->paginate(5);
    }

    /**
     * @return array
     */
    protected function getProductSearchRules(){
        return [
            'page'=>'nullable|integer|min:1',
            'category'=>'nullable|string|min:2|max:255',
            'priceLessThan'=>'nullable|integer|min:1',
        ];
    }

}