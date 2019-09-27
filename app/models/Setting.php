<?php

use illuminate\Database\Eloquent\Model as Eloquent;

class Setting  extends Eloquent
{
    public $timestamps = false;

    protected $guarded = [];
    protected $table = 'settings';
}