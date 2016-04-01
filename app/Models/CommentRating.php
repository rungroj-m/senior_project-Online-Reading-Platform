<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class commentRating extends Model
{

    protected $table = 'commentRatings';
    protected $fillable = array('comment_id','user_id');
    protected $primaryKey = 'id';

}
