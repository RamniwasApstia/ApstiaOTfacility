<?php

namespace Hospital\Ot\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class OTSetting extends Model
{
    use HasFactory,SoftDeletes;
      

    protected $table = "ot_setting";

    protected $fillable = [

       'OT_price',
       'OT_number',
      

    ];
    protected $primaryKey = "id";

}
