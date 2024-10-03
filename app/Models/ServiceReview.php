<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceReview extends Model
{
    protected $fillable = [
        'service_id',
        'comment',
        'rate',
        'request_id',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/service-reviews/'.$this->getKey());
    }
}
