<?php

namespace Hospital\Ot\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class OTTime extends Model
{
    use HasFactory;
      

    protected $table = "ot_time";

    protected $fillable = [

       'day',
       'from',
       'to',
       'ot_id',
     
      
      

    ];
    protected $primaryKey = "time_id";

}
