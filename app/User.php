<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Definiendo Relacion entre usuario y Cart 1 --> *
    public function carts() {

        return $this->hasMany(Cart::class);
    }

    public function payments() {

        return $this->hasMany(Payment::class);
    }

    //Definicion de un accesor
    public function getCartAttribute() {

        $cart = $this->carts()->where('status', 'Active')->first();
        if ($cart)
            return $cart;

        $cart = new Cart();
        $cart->status = 'Active';
        $cart->user_id = $this->id;
        $cart->save();

        return $cart;
    }

    public function getDebitAttribute() {
        if ($this->carts()->where('status', 'Approved')->count() > 0) {

            $payments = $this->carts->where('status', 'Approved')->first()->event->payments;
            $costoDelEvento = $this->carts->where('status', 'Approved')->first()->event->total_cost;

            $montoPagado = 0;
            foreach ($payments as $key => $payment) {
                $montoPagado = $montoPagado + $payment->amount;
            }

            return $costoDelEvento - $montoPagado;
        }
        return 0;
    }

}
