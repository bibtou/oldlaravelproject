<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{
	Page, Block
};

class BlockLink extends Model
{
    protected $fillable = ['block_id', 'page_id', 'position', 'user_id', 'url'];

	public function block()
	{
		return $this->belongsTo(Block::class)->withDefault([]);
	}

	public function page()
	{
		return $this->belongsTo(Page::class)->withDefault([]);
	}
}
