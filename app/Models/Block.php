<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\BlockLink;

use App\Models\Page;

class Block extends Model
{
	const HIDDEN = 0;
	const VISIBLE = 1;

	protected $fillable = ['visible', 'title', 'description', 'slug', 'position', 'user_id'];

    public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function pages()
	{
		return $this->belongsToMany(Page::class, BlockLink::class)->withPivot('url');
	}
}
