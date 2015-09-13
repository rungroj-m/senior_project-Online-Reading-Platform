<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentInfo extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'contentInfo';
	protected $fillable = array('name','description','userRatingCount','userRating','criticRating','TAG','category');
	protected $primaryKey = 'contentKey';
}
