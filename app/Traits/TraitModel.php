<?php

namespace App\Traits;

trait TraitModel{		  
    public function getGetHumanCreatedAtAttribute(){
        if(isset($this->attributes["created_at"])){
           return now()->parse($this->attributes['created_at'])->diffForHumans();    
        }

        return Null;
    }

    public function getGetHumanUpdatedAtAttribute(){
        if(isset($this->attributes["updated_at"])){
           return now()->parse($this->attributes['updated_at'])->diffForHumans();    
        }

        return Null;
    }    
}