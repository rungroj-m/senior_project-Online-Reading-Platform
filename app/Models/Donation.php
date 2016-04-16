<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Donation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $fillable = array('user_id', 'book_id', 'goal_amount', 'active', 'description');
    protected $primaryKey = 'id';

    public function user() {
      return $this->belongsTo('App\Models\User');
    }

    public function book() {
      return $this->belongsTo('App\Models\Book');
    }

    public function plead() {
      return $this->hasMany('App\Models\Pleading');
    }

    public function sum(){
        return DB::table('pleadings')->where('donation_id',$this->id)->where('confirmed',1)->sum('amount');
    }
}
