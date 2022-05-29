<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;

    protected $table      = 'periodo';
    public $incrementing  = true;
    public $timestamps    = false;
    protected $primaryKey = 'periodo_id';
    protected $guarded = [];
}
