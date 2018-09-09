<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
  protected $table = 'schedule';

  protected $fillable = [
      'schedule_name',
      'schedule_start_date',
      'schedule_end_date',
      'schedule_venue'
  ];
}
