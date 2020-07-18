<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyLog extends Model
{
    protected $fillable = ['attendance_id','wsys_no','status','latitude','longitude'];
}
