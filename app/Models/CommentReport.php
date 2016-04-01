<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentReport extends Model
{
    protected $table = 'comment_reports';
    protected $fillable = array('comment_id','user_id','type');
    protected $primaryKey = 'id';
}
