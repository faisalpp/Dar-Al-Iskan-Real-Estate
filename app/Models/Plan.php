<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    public function Deposit(){
        return  $this->belongsTo(Deposit::class,'plan_id','plan_id');
    }
}
