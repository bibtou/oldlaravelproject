<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\{
	User,
	Category
};

class Article extends Model
{
	const PUBLIC_AND_PRIVATE_POST = -1;
	const PUBLIC_POST  = 0;
	const PRIVATE_POST = 1;
	const UNPUBLISHED = 0;
	const PUBLISHED = 1;
	
	protected $with = ['user', 'category'];
	
	protected $perPage = 10;
	
	public function scopePublished($query, $private = false)
	{
		if ($private === self::PUBLIC_POST) {
			return $query->dateMaxNow()
				->where('published', true)
				->private(false);
		} elseif ($private === self::PRIVATE_POST) {
			return $query->dateMaxNow()
				->where('published', true)
				->private();
		} else {
			return $query->dateMaxNow()
				->where('published', true);
		}
	}
	
	public function scopePublishedByCategory($query, $id, $private = false)
	{
		return $this->published($private)->where('category_id', $id);
	}
	
	public function scopeArchives($query, $private = false)
	{
		return $this->published($private)->groupBy('displayed_at');
	}
	
	public function scopePrivate($query, $boolean = true)
	{
		return $query->where('private', $boolean);
	}
	
	public function scopeDateMaxNow($query)
	{
		return $query->where('displayed_at', '<=', date('Y-m-d H:i:s'));
	}
	
	/**
	 * Find article by own slug
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $slug
	 * @param boolean|null $private false
	 */
	public function scopeArticleBlog($query, $slug, $private = false)
	{
		return $query->published($private)
			->where('slug', $slug)
			->firstOrFail();
	}
	
	public function scopeSearchOnBlog($query, $value, $private = false)
	{
		return $query->published($private)
			->where(function($query) use ($value) {
				return $query->where('title', 'LIKE', '%' . $value . '%')
							 ->orWhere('description', 'LIKE', '%' . $value . '%');
			});
	}
	
    public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function category()
	{
		return $this->belongsTo(Category::class);
	}
	
	public function getFormattedDateToText($value) : string
	{
		return date('d/m/Y à H:i', strtotime($value));
	}
	
	public function getCreatedAtFormattedAttribute() {
		return $this->getFormattedDateToText($this->created_at);
	}
	
	public function getUpdatedAtFormattedAttribute() {
		return $this->getFormattedDateToText($this->updated_at);
	}

	public function getDisplayedAtFormattedAttribute() {
		return $this->getFormattedDateToText($this->displayed_at);
	}
	
	/**
	 * The query must be contains a column or an alias named displayed_at_month
	 *
	 * Add 0 before a number if it is less than 10
	 *
	 * @param string
	 * @return string
	 */
	public function getDisplayedAtMonthAttribute($value) : string
	{
		$value = ltrim($value, 0);
		
		return $value < 10 ? (0 . $value) : $value;
	}
	
	
	
	public function saveOrCreate(Article $article)
	{
		dd($article);
	}
}
