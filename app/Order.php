<?php

namespace App;

use Alexo\LaravelPayU\Payable;
use Alexo\LaravelPayU\Searchable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use Payable, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference', 'state', 'value', 'payu_order_id', 'transaction_id', 'user_id'
    ];
}
