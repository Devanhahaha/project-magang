<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'image',
        'category',
        'title',
        'description',
        'tanggal',
    ];
}
