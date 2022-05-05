<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{
	Link, User
};

class Domain extends Model
{
	protected $fillable = [
		'domain',
		'user_id'
	];

    public function links()
	{
		return $this->hasMany(Link::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
