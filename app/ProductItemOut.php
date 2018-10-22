<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductItemOut extends Model
{
  protected $table = 'product_item_out';

  protected $fillable = [
    'product_item_id',
    'request_date',
    'request_notes',
    'request_status_id',
    'qty',
    'user_id',
    'approved_by',
    'approved_date',
    'product_eta',
    'product_return_date',
    'return_status_id',
    'remarks'
  ];
}
