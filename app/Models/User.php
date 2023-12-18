<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;
use App\Models\Account;
use App\Models\Transaction;

class User extends Model
{
    use HasFactory;
    public function MasterPlan(){
       return $this->hasOne(MasterPlan::class,'user_name','user_name');
    }
    public function Profile(){
       return $this->hasOne(Profile::class,'user_name','user_name');
    }
    public function Transactions(){
       return $this->hasMany(Transaction::class,'user_name','user_name');
    }
    public function Account(){
        return $this->hasOne(Account::class,'user_name','user_name');
    }
    public function RequestAds(){
        return $this->hasMany(UserAdRequest::class,'user_name','user_name');
    }
}
