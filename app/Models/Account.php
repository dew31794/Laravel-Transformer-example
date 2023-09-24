<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Account extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'account',
        'password',
        'staff_id',
        'status',
        'remark',
    ];

    public function staff()
    {
    	return $this->belongsTo('App\Models\StaffInfo', 'staff_id', 'id');
    }
}
