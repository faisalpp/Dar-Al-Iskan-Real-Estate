<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public function Plan(){
        return  $this->hasOne(Plan::class,'plan_id','plan_id');
      }
    public function User(){
        return  $this->hasOne(User::class,'user_name','user_name');
      }
}
