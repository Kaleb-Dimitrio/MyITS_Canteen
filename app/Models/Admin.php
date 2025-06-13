<?php

// FILE: app/Models/Admin.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     */
    protected $table = 'admin';

    /**
     * The primary key associated with the table.
     */
    protected $primaryKey = 'admin_id';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'admin_nama',
        'admin_email',
        'admin_password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'admin_password',
    ];

    /**
     * An Admin can manage many Tokos (stores).
     */
    public function tokos()
    {
        return $this->hasMany(Toko::class, 'admin_id', 'admin_id');
    }
}