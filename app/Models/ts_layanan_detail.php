<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ts_layanan_detail extends Model
{
    use HasFactory;
    protected $table = 'ts_layanan_detail';
    protected $connection = 'mysql2';
    protected $guarded = ['id'];
}
