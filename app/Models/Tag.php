<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $fillable = array('tag');
	protected $primaryKey = 'id';

	public function books() {
		return $this->belongsToMany('App\Models\Book', 'book_tags', 'tag_id', 'book_id');
	}
}
