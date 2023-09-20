<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Project extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'num',
        'name',
        'description',
        'staff_id',
        'sort',
        'start_date',
        'end_date',
        'status',
        'remark',
    ];

    public function staff()
    {
    	return $this->belongsTo('App\Models\StaffInfo', 'staff_id', 'id');
    }
}
