<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\TraitModel;

class User extends Authenticatable
{
    use Notifiable;

    use TraitModel;

    protected $guarded = ["id"];

    protected $hidden = [
        'password'
    ];   

    protected $appends = [    
        "get_human_created_at",
        "get_human_updated_at"
    ];

    public function invoices(){    
        return $this->hasMany(Invoice::class);        
    }
    
    public function reviewes(){        
        return $this->hasMany(Review::class);
    }

    public function manual_payments(){        
        return $this->hasMany(ManualPayment::class);
    }

    public function notifications(){    
        return $this->hasMany(Notification::class);
    }

    public function setPasswordAttribute($value){
        $this->attributes['password'] = \Hash::make($value); 
    }

    public function getPhotoOriginalAttribute($value){
        return $this->attributes["photo"];
    }
}