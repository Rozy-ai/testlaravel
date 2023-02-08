<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Valuta extends Model
{
    public $fillable = ['valuta', 'code', 'procent'];
    
protected $table = 'valuta';

// protected $primaryKey = 'id';
// public $timestamps = false;
protected $guarded = ['id'];
// protected $hidden = [];
// protected $dates = [];
}
