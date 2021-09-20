<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TraitModel;

class Notification extends Model
{
    use TraitModel;
    
    protected $guarded = ["id"];
    
    protected $appends = [    
        "get_human_created_at",
        "get_human_updated_at"
    ];  
}