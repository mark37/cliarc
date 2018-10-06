<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
  protected $table = 'schedule';

  protected $primaryKey = 'schedule_id';

  protected $fillable = [
      'schedule_name',
      'schedule_desc',
      'schedule_start_date',
      'schedule_end_date',
      'schedule_venue'
  ];
}
