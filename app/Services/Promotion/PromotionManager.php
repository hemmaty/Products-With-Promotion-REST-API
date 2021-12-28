<?php

namespace App\Services\Promotion;


use App\Contracts\Promotion\PromotionManagerInterface;
use App\Enum\Common\Status;
use App\Enum\Promotion\PromotionalConditionalType;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Support\Facades\DB;

class PromotionManager implements PromotionManagerInterface
{
    /**
     * @var Promotion
     */
    private $promotion;

    /**
     * PromotionManager constructor.
     * @param Promotion $promotion
     */
    public function __construct(Promotion $promotion)
    {
        $this->promotion = $promotion;
    }

    /**
     * @return PromotionManager
     */
    public function apply(): self
    {
        switch ($this->promotion->condition_type) {
            case PromotionalConditionalType::CONDITIONAL_TYPE_CATEGORY:
                $result = $this->applyCategoryPromotion();
                break;
            case PromotionalConditionalType::CONDITIONAL_TYPE_SKU:
                $result = $this->applySkuPromotion();
                break;
        }
        if ($result) {
            $this->applyPromotionStatus();
        }
        return $this;
    }


    /**
     * @return bool
     */
    private function applyCategoryPromotion(): bool
    {
        try {
            Product::whereHas('categories', function ($query) {
                $query->where('name', $this->promotion->condition_value);
            })->where(function($query){
                $query->where('discount_percentage', '<', $this->promotion->discount_percentage)->orWhereNULL('discount_percentage');
            })
            ->update(['final_price' => DB::raw($this->getPriceUpdateRaw($this->promotion->discount_percentage)), 'discount_percentage' => $this->promotion->discount_percentage]);
            return true;
        } catch (\Exception $e) {
            report($e);
        }
        return false;
    }


    /**
     * @return bool
     */
    private function applySkuPromotion(): bool
    {
        try {
            Product::where('sku', $this->promotion->condition_value)
                ->where(function($query){
                    $query->where('discount_percentage', '<', $this->promotion->discount_percentage)->orWhereNULL('discount_percentage');
                })
                ->update(['final_price' => DB::raw($this->getPriceUpdateRaw($this->promotion->discount_percentage)), 'discount_percentage' => $this->promotion->discount_percentage]);
            return true;
        } catch (\Exception $e) {
            report($e);
        }
        return false;
    }

    /**
     * @return PromotionManager
     */
    private function applyPromotionStatus(): self
    {
        $this->promotion->applied_at = date('Y-m-d H:i:s');
        $this->promotion->status = Status::STATUS_APPLIED;
        $this->promotion->save();
        return $this;
    }

    /**
     * @param $discount_percentage
     * @return string
     */
    private function getPriceUpdateRaw($discount_percentage)
    {
        return '(`actual_price`-(`actual_price` * ' . $discount_percentage . ' / 100.0))';
    }
}