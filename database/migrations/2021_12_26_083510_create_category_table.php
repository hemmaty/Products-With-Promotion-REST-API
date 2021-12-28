<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('parent_id')->nullable()->constrained('categories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name',255);
            $table->string('slug',500)->unique();
            $table->text('short_description')->nullable();
            $table->enum('status',['enable','disable'])->default('enable');
            $table->mediumInteger('position')->default(0);
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
        Schema::table('categories', function(Blueprint $table) {
            $table->dropForeign('categories_parent_id_foreign');
        });
        Schema::dropIfExists('categories');
    }
}
