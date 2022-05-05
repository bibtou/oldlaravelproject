<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
use App\Models\User;

class Category extends Model
{
    public function articles()
	{
		return $this->hasMany(Article::class);
	}
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function getFormattedDateToText($value) : string
	{
		return date('d/m/Y à H:i', strtotime($value));
	}
}
