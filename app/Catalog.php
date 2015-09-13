<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'catalog';
	protected $fillable = array('userKey','bookKey','price');
	protected $primaryKey = 'catalogKey';
}
