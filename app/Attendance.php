<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['user_id','time_in','time_out','lat','lng','lat_out','long_out'];

    protected $dates=[
        'time_in',
        'time_out',
    ];

    protected $appends=["timeAppIn","timeAppOut","dateChekin"];

    public function owner()
    {
       return $this->belongsTo(User::class);
    }

    public function gettimeAppInAttribute()
    {
       return $this->time_in->format('H:i A');
    }

    public function gettimeAppOutAttribute()
    {
        $out= $this->time_out;
        if($out)
            return $this->time_out->format('H:i A');
        else
            return "Pending Checkout";
    }

    public function getdateChekinAttribute()
    {
        return $this->time_in->format('d-m-Y');
    }

}
