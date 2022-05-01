<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get all of the comments for the Categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function post()
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }

    public function scopeLates($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function postCount()
    {
        return $this->post->count();
    }
}
