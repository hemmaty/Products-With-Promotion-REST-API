<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('condition_type',['category','sku']);
            $table->string('condition_value');
            $table->decimal('discount_percentage',5,2)->default(0);
            $table->string('currency_code',3);
            $table->enum('status',['enable','applied','disable'])->default('enable');
            $table->timestamp('applied_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
