<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;

class Profile extends Model implements Sortable
{
    use HasTranslation, HasSlug, HasMedias, HasFiles, HasRevisions, HasPosition;

    protected $fillable = [
        'published',
        'title',
        'description',
        'position',
    ];
    
    public $translatedAttributes = [
        'title',
        'description',
    ];
    
    public $slugAttributes = [
        'title',
    ];
    
}
