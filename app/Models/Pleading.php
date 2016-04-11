<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pleading extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $fillable = array('user_id', 'donation_id', 'amount', 'confirmed');
    protected $primaryKey = 'id';

    public function user() {
      return $this->belongsTo('App\Models\User');
    }

    public function donation() {
      return $this->belongsTo('App\Models\Donation');
    }
}
