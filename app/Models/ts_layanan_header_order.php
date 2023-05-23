<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ts_layanan_header_order extends Model
{
    use HasFactory;
    protected $table = 'ts_layanan_header_order';
    protected $guarded = ['id'];
}
