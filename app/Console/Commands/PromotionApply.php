<?php
namespace App\Console\Commands;

use App\Enum\Common\Status;
use App\Models\Promotion;
use App\Services\Promotion\PromotionManager;
use Illuminate\Console\Command;

class PromotionApply extends Command
{


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'promotion:apply';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'apply promotion to all products';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Promotion::where('status',Status::STATUS_ENABLE)->chunk(10,function($promotions){
            foreach($promotions as $promotion){
                $promotionManager=new PromotionManager($promotion);
                $promotionManager->apply();
            }
        });
    }

}
