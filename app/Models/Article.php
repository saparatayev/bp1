<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\Sluggable;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use CrudTrait;
    use HasFactory;
    use SoftDeletes;
    use Sluggable, SluggableScopeHelpers;
    use HasTranslations;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'metas'
    ];
    
    protected $fakeColumns = [
        'metas'
    ];
    
    protected $casts = [
        'metas' => 'array',
    ];

    protected $translatable = [
        'title',
        'slug',
        'description'
    ];

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'article_tag');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true,
                'onCreate' => true,
                'translatable' => true, // Enable multilingual slugs
                'translatable_separator' => '-', // Separator for translated slugs
            ],
        ];
    }
}

