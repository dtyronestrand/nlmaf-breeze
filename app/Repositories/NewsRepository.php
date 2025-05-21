<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\News;

class NewsRepository extends ModuleRepository
{
    use HandleBlocks, HandleSlugs;

    public function __construct(News $model)
    {
        $this->model = $model;
    }
}
