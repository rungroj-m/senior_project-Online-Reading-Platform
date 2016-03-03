<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class commentRating extends Model
{

    protected $table = 'commentRatings';
    protected $fillable = array('commentKey','userKey');
    protected $primaryKey = 'commentRatingKey';

}
