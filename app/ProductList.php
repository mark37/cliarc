<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductList extends Model
{
  protected $table = 'product_list';

  protected $fillable = [
      'product_name',
      'product_desc',
      'product_unit',
      'product_type',
      'product_status'
  ];
}
