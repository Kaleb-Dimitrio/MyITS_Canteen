<?php
// FILE: app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'order_tanggal',
        'order_total_harga',
        'order_status_pesanan',
        'order_no_meja',
        'order_status_pembayaran',
        'customer_id',
        'toko_id',
        'cashier_id',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'order_tanggal' => 'datetime',
        'order_status_pembayaran' => 'boolean',
    ];

    /**
     * An Order belongs to one Customer.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    /**
     * An Order belongs to one Toko.
     */
    public function toko()
    {
        return $this->belongsTo(Toko::class, 'toko_id', 'toko_id');
    }

    /**
     * An Order is handled by one Cashier.
     */
    public function cashier()
    {
        return $this->belongsTo(Cashier::class, 'cashier_id', 'cashier_id');
    }

    /**
     * An Order has many Menu items.
     */
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_order', 'order_id', 'menu_id')
                    ->withPivot('kuantitas') // Important: to access the quantity
                    ->withTimestamps();
    }
}