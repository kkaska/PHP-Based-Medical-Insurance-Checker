<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Hospital extends Model
{
    use Sortable;

    protected $table = 'hospital';
    protected $primaryKey = 'Id';
    public $incrementing = false;
    public $timestamps = false;
}
