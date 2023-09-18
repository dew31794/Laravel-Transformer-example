<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class StaffInfo extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'num',
        'name',
        'gender',
        'phone',
        'email',
        'arrival_date',
        'resignation_date',
        'department',
        'job_title',
        'status',
        'remark',
    ];

    public function childrenProject()
    {
    	return $this->hasMany('App\Models\Project', 'staff_id', 'id');
    }
}
