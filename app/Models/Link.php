<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{
	Domain, User
};

class Link extends Model
{
	protected $fillable = [
		'fingerprint', 'link', 'domain_id', 'user_id'
	];

	protected $with = ['domain'];

    public function domain()
	{
		return $this->belongsTo(Domain::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
