<?php

use illuminate\Database\Eloquent\Model as Eloquent;

class DataLog  extends Eloquent
{
    public $timestamps = false;

    protected $guarded = [];
    protected $table = 'data_logs';
}