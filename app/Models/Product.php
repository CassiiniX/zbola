<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TraitModel;

class Product extends Model
{
    use TraitModel;
    
    protected $guarded = ["id"];
    
    protected $appends = [    
        "get_human_created_at",
        "get_human_updated_at",
        "get_star",
        "get_images"
    ];

    public function getGetStarAttribute(){
        if(isset($this->attributes['star'])){
            $star = "";

            if($this->attributes['star'] == 0){
                for($i=0;$i<5;$i++){
                    $star .= "<i class='fe fe-star'
                        style='color:gray'></i>";
                }     
                     
                return $star;
            }
    
            for($i=0;$i<$this->attributes['star'];$i++){
                $star .= "<i class='fe fe-star' style='color:green'></i>";
            }        

            return $star;
        }

        return Null;
    }

    public function getGetImagesAttribute(){                    
        if(isset($this->attributes['images'])){    
            return json_decode($this->attributes['images']);
        }

        return Null;
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}