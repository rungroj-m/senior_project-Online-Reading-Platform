<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewReport extends Model
{
    protected $table = 'review_reports';
    protected $fillable = array('review_id','user_id','type');
    protected $primaryKey = 'id';
}