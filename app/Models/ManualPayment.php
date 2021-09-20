<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TraitModel;

class ManualPayment extends Model
{
    use TraitModel;
    
    protected $guarded = ["id"];
    
    protected $appends = [    
        "get_human_created_at",
        "get_human_updated_at",        
    ];
 
    public function invoice(){    
        return $this->belongsTo(Invoice::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}