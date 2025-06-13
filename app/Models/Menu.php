<?php
// FILE: app/Models/Menu.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $primaryKey = 'menu_id';

    protected $fillable = [
        'menu_nama',
        'menu_harga',
        'menu_stok',
        'menu_gambar',
        'menu_kategori',
        'toko_id',
    ];

    /**
     * A Menu item belongs to one Toko.
     */
    public function toko()
    {
        return $this->belongsTo(Toko::class, 'toko_id', 'toko_id');
    }

    /**
     * A Menu item can be in many Orders.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'menu_order', 'menu_id', 'order_id')
                    ->withPivot('kuantitas') // Important: to access the quantity
                    ->withTimestamps();
    }
}