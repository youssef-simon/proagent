<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceStatus extends Model
{
    protected $table = 'service_status';

    protected $fillable = [
        'title',
        'code',
        'color',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/service-statuses/'.$this->getKey());
    }
}
