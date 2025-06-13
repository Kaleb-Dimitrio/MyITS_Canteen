<?php
// FILE: app/Models/Cashier.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Cashier extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'cashier';
    protected $primaryKey = 'cashier_id';

    protected $fillable = [
        'cashier_nama',
        'cashier_email',
        'cashier_no_telp',
        'cashier_password',
        'toko_id',
    ];

    protected $hidden = [
        'cashier_password',
    ];

    /**
     * A Cashier belongs to one Toko.
     */
    public function toko()
    {
        return $this->belongsTo(Toko::class, 'toko_id', 'toko_id');
    }

    /**
     * A Cashier can process many Orders.
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'cashier_id', 'cashier_id');
    }
}