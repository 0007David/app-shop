<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    
     public function cart()
    {
        return $this->belongsTo('App\Cart');
    }

    //Accesor
    public function getApplicationDateAttribute(){

		return $this->created_at->format('Y-m-d');
    }

     //Accesor
    public function getEventDateAttribute(){
    	
		return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->date)->format('Y-m-d'); 
    }

    public function getEventHourAttribute(){
        
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->date)->format('H:i:s'); 
    }
}
