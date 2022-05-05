<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Category;
use App\Models\Article;
use App\Models\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

	protected $perPage = 10;

	public function categories() {
		return $this->hasMany(Category::class);
	}

	public function articles()
	{
		return $this->hasMany(Article::class);
	}
	
	public function role()
	{
		return $this->belongsTo(Role::class);
	}

	public function getFormattedDateToText($value) : string
	{
		return date('d/m/Y à H:i', strtotime($value));
	}
	
	public function getCreatedAtFormattedAttribute() {
		return $this->getFormattedDateToText($this->created_at);
	}
}
