<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TraitModel;

class Invoice extends Model
{
    use TraitModel;
    
    protected $guarded = ["id"];
    
    protected $appends = [    
        "get_human_created_at",
        "get_human_updated_at"
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function manual_payment(){
        return $this->hasMany(ManualPayment::class);
    }
}