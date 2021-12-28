<?php
namespace App\Contracts\Promotion;


use App\Models\Promotion;

Interface PromotionManagerInterface
{
    /**
     * PromotionManager constructor.
     * @param Promotion $promotion
     */
    public function __construct(Promotion $promotion);


    /**
     * @return PromotionManagerInterface
     */
    public function apply(): self;

}