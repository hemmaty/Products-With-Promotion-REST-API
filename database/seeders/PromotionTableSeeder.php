<?php

namespace Database\Seeders;

use App\Enum\Common\Status;
use App\Enum\Currency\CurrencyCode;
use App\Enum\Promotion\PromotionalConditionalType;
use App\Enum\Promotion\PromotionType;
use App\Models\Promotion;
use Illuminate\Database\Seeder;

class PromotionTableSeeder extends Seeder
{
    private $promotions = [
        [
            'name'=>'boots category 30% discount',
            'condition_type'=>PromotionalConditionalType::CONDITIONAL_TYPE_CATEGORY,
            'condition_value'=>'boots',
            'discount_percentage'=>30,
            'currency_code'=>CurrencyCode::CURRENCY_EURO,
        ],
        [
        'name'=>'SKU 000003 15% discount',
        'condition_type'=>PromotionalConditionalType::CONDITIONAL_TYPE_SKU,
        'condition_value'=>'000003',
        'discount_percentage'=>15,
        'currency_code'=>CurrencyCode::CURRENCY_EURO,
    ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->promotions as $promotion){
            $promotionModel=Promotion::where('name',$promotion['name'])->first();
            if(!$promotionModel){
                Promotion::create($promotion);
            }else{
                $promotionModel->status=Status::STATUS_ENABLE;
                $promotionModel->save();
            }
        }
    }
}
