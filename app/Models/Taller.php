<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    use HasFactory;
    protected $table      = 'taller';
    public $incrementing  = true;
    public $timestamps    = false;
    protected $primaryKey = 'taller_id';
    protected $guarded = [];
}
