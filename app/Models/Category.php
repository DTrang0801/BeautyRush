<?php

namespace App\Models;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /** @use HasFactory<CategoryFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id', 'id');
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class);
    }
}
