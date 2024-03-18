<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;

class Partner extends Model
{
    use HasFactory;
    protected $table = "partner_pages";
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'slug',
        'category',
        'content',
        'meta_title',
        'meta_description'
    ];
}