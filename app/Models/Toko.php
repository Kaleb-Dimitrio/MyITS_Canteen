<?php
// FILE: app/Models/Toko.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    use HasFactory;

    protected $table = 'toko';
    protected $primaryKey = 'toko_id';

    protected $fillable = [
        'toko_nama',
        'toko_no_rekening',
        'toko_gambar',
        'admin_id',
    ];

    /**
     * A Toko belongs to one Admin.
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'admin_id');
    }

    /**
     * A Toko has many Cashiers.
     */
    public function cashiers()
    {
        return $this->hasMany(Cashier::class, 'toko_id', 'toko_id');
    }

    /**
     * A Toko has many Menu items.
     */
    public function menus()
    {
        return $this->hasMany(Menu::class, 'toko_id', 'toko_id');
    }

    /**
     * A Toko has many Orders.
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'toko_id', 'toko_id');
    }
}