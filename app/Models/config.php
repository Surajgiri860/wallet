<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;
    
    protected $table = 'percentage'; // टेबल का नाम
    protected $fillable = ['key', 'value'];
    public $timestamps = true;

}
