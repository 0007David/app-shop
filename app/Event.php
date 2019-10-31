<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {

    public function cart() {
        return $this->belongsTo('App\Cart');
    }

    //Accesor
    public function getApplicationDateAttribute() {

        return $this->created_at->format('Y-m-d');
    }

    //Accesor
    public function getEventDateAttribute() {

        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->date)->format('Y-m-d');
    }

    public function getEventHourAttribute() {

        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->date)->format('H:i:s');
    }

    public function payments() {

        return $this->hasMany(Payment::class);
    }

    /**
     * Costo de Organizar el evento (costo de transporte + coste del producto)
     * @return [type] [description]
     */
    public function getTotalCostAttribute() {
        $totalAmount = round($this->total_amount);
        $transportCost = round($this->transport_cost);
        return $totalAmount + $transportCost;
    }

    public function getAmountToPayAttribute() {

        $amountToPay = round($this->total_cost * 0.5);

        return $amountToPay;
    }

}
