<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $fillable = [
        'banner',
        'title',
        'subtitle',
        'description',
    ];
}
