<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\HasRelated;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\HasNesting;
use A17\Twill\Models\Behaviors\Sortable;
use App\Models\Base\Model;

class MenuLink extends Model implements Sortable
{
    use HasTranslation, HasPosition, HasRelated, HasNesting;

    protected $fillable = [
        'published',
        'title',
        'position',
    ];
    
    public $translatedAttributes = [
        'title',
     
    ];
    
}
