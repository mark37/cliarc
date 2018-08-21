<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
  protected $table = 'product_item';

  protected $fillable = [
      'product_id',
      'status_id'
  ];
}
