<?php

namespace App\Traits\Category;


use App\Models\Category;

trait CategoryHelper
{

    protected function getCategory($name){
        return Category::where('name',$name)->first();
    }

}