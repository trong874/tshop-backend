<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'description',
        'status',
        'seo_slug',
        'seo_title',
        'seo_description',
    ];

    protected $hidden = [
      'updated_at',
    ];


    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class,'parent_id','id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }
}
