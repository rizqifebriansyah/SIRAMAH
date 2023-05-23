<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_kunjungan extends Model
{
    use HasFactory;
    protected $connection = 'mysql3';
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'data_kunjungan';
    protected $guarded = ['idx'];
}
