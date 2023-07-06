<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Movie extends Model
{
	use HasFactory,HasTranslations;

	protected $guarded = ['id'];

	public $translatable = ['title', 'director', 'description'];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function genres(): BelongsToMany
	{
		return $this->BelongsToMany(Genre::class, 'genre_movie');
	}
}
