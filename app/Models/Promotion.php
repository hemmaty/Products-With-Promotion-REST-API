<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use SoftDeletes;

    protected $table = 'promotions';

    protected $fillable = ['name','condition_type','condition_value','discount_percentage','currency_code','status','applied_at'];

}
