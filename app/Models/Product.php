<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = ['sku','name','currency_code','actual_price','final_price','discount_percentage','status'];


    /**
     * @return mixed
     */
    public function getCategoryNameAttribute()
    {
        $category=$this->categories()->wherePivot('is_main','=',1)->select('name')->first();
        if($category){
            return $category->name;
        }
        return '';
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class,'product_categories');
    }
}
