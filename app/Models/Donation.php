<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $fillable = array('user_id', 'book_id', 'goal_amount', 'active');
    protected $primaryKey = 'id';

    public function owner() {
      return $this->belongsTo('App\Models\User');
    }

    public function book() {
      return $this->belongsTo('App\Models\Book');
    }

    public function plead() {
      return $this->hasMany('App\Models\Pleading');
    }
}
