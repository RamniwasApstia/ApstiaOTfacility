<?php

namespace Hospital\Ot\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class OTBook extends Model
{
    use HasFactory ,SoftDeletes;
      

    protected $table = "ot_booking";

    protected $fillable = [

       'ot_price',
       'ot_number',
       'booking_date',
       'booking_time',
       'doctor',
       'requested_by',
       'patient',
      
      

    ];
    protected $primaryKey = "id";

}
