<?php

namespace Database\Seeders;

use App\Enum\Currency\CurrencyCode;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    private $products = [
            [
                "sku" => "000001",
                "name" => "BV Lean leather ankle boots",
                "category" => "boots",
                "price" => 89000
            ],
            [
                "sku" => "000002",
                "name" => "BV Lean leather ankle boots",
                "category" => "boots",
                "price" => 99000
            ],
            [
                "sku" => "000003",
                "name" => "Ashlington leather ankle boots",
                "category" => "boots",
                "price" => 71000
            ],
            [
                "sku" => "000004",
                "name" => "Naima embellished suede sandals",
                "category" => "sandals",
                "price" => 79500
            ],
            [
                "sku" => "000005",
                "name" => "Nathane leather sneakers",
                "category" => "sneakers",
                "price" => 59000
            ],
            [
                "sku" => "000006",
                "name" => "BV Lean leather ankle boots 1",
                "category" => "boots",
                "price" => 89000
            ],
            [
                "sku" => "000007",
                "name" => "BV Lean leather ankle boots 1",
                "category" => "boots",
                "price" => 99000
            ],
            [
                "sku" => "000008",
                "name" => "Ashlington leather ankle boots 1",
                "category" => "boots",
                "price" => 71000
            ],
            [
                "sku" => "000009",
                "name" => "Naima embellished suede sandals 1",
                "category" => "sandals",
                "price" => 79500
            ],
            [
                "sku" => "000010",
                "name" => "Nathane leather sneakers 1",
                "category" => "sneakers",
                "price" => 59000
            ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->products as $product){
            $category_id=$this->getCategoryID($product['category']);
            $productItem=[
                'sku'=>$product['sku'],
                'name'=>$product['name'],
                'actual_price'=>$product['price'],
                'final_price'=>$product['price'],
                'currency_code'=>CurrencyCode::CURRENCY_EURO,
            ];
            $productModel=Product::where('sku',$product['sku'])->first();
            if($productModel){
                $productModel->update($productItem);
            }else{
                $productModel=Product::create($productItem);
            }
            if($productModel){
                $productModel->categories()->sync([$category_id=>['is_main'=>1]]);
            }
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getCategoryID($name){
        $category=Category::where('name',$name)->first();
        if($category){
            return $category->id;
        }
        $categoryItem=[
            'name'=>$name,
            'slug'=>$name,
        ];
        $category=Category::create($categoryItem);
        return $category->id;
    }
}
