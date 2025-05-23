<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\HasNesting;
use A17\Twill\Models\Behaviors\Sortable;
use App\Models\Base\Model;

class Program extends Model implements Sortable
{
    use HasBlocks, HasSlug, HasMedias, HasRevisions, HasPosition, HasNesting;

    protected $fillable = [
        'published',
        'title',
        'meta_title',
        'meta_description',
        'position',
        'blocks',
    ];
    
    public $slugAttributes = [
        'title',
    ];
    
    public  $publicAttributes = [
        'id',
        'title',
        'slug',
        'blocks',
        'medias',
        'meta_title',
        'meta_description',
        'position'
    ];
}
