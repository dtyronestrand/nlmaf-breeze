<?php

namespace App\View\Components\Twill\Blocks\Common;

use A17\Twill\Services\Forms\Fields\Wysiwyg;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\InlineRepeater;
use A17\Twill\Services\Forms\Fields\Medias;


class Landing extends Base
{


    public function getForm(): Form
    {
        return Form::make([
            Input::make()->name('heading'),
            Wysiwyg::make()->name('details'),
            InlineRepeater::make()->name('programs')
            ->triggerText(__('Add Program'))
            ->fields([
                Input::make()->name('title'),
                Input::make()->name('details'),
                Input::make()->name('link'),
                Medias::make()->name('image')->max(1),
            ])
        ]);
    }
    public static function getBlockTitle(): string
    {
        return __('Landing');
    }
    public static function getBlockIcon(): string{
        return 'image';
    }
}
