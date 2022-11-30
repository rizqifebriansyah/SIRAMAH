<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ihs_pasien extends Model
{
    use HasFactory;
    protected $table = 'ihs_pasien';
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $guarded = ['id'];
}
