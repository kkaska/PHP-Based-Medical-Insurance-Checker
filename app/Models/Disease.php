<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    protected $table = 'drgdefinition';
    protected $primaryKey = 'Id';
    public $incrementing = false;
    public $timestamps = false;
}