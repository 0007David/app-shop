<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductUnit extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id','unit_id'];

    /**
     * Metodo que define la relacion de la tabla ProductUnit -> Unit
     */

    public function unit(){

    	return $this->belongsTo(Unit::class);
    }
    
}
