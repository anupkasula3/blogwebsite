<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metapage extends Model
{
    protected $fillable = [
        'page_name',
        'meta_title',
        'meta_description',
        'ogimage',
        'img_alt',
        'keywords'
    ];
}
