<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookReport extends Model
{
    protected $table = 'book_reports';
    protected $fillable = array('book_id','user_id','type');
    protected $primaryKey = 'id';
}
