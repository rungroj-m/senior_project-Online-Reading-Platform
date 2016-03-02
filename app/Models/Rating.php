<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';
    protected $fillable = array('bookKey','userKey');
    protected $primaryKey = 'bookKey';
}
