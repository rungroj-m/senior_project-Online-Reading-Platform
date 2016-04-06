<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reviewRating extends Model
{

    protected $table = 'reviewRatings';
    protected $fillable = array('review_id','user_id');
    protected $primaryKey = 'id';

}
