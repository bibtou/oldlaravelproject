<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{
	Link, User, Block, BlockLink
};

class Page extends Model
{
	const UNPUBLISHED = 0;
    const PUBLISHED   = 1;

	const PUBLIC_POST  = 0;
	const PRIVATE_POST = 1;

	protected $fillable = [
		'published', 'private', 'title', 'slug', 'description', 'content', 'link_id', 'user_id'
	];

	protected $with = ['user', 'link'];

	protected $perPage = 10;

	public function link()
	{
		return $this->belongsTo(Link::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function blocks()
	{
		return $this->belongsToMany(Block::class, BlockLink::class);
	}
}
