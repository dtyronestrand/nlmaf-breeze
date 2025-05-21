<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\Behaviors\HandleNesting;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Program;
use Illuminate\Support\Facades\Cache;

class ProgramRepository extends ModuleRepository
{
    use HandleBlocks, HandleSlugs, HandleMedias, HandleRevisions, HandleNesting;

    public function __construct(Program $model)
    {
        $this->model = $model;
    }
        public function afterSave($object, $fields): void
    {
        foreach (optional($object)->slugs as $slug) {
            Cache::forget('page.' . $slug->locale . '.' . $slug->slug);
        }
        parent::afterSave($object, $fields);
    }
}
