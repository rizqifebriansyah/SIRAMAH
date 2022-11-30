<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ihs_encounter extends Model
{
    use HasFactory;
    protected $table = 'ihs_encounter';
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $guarded = ['id'];
}
