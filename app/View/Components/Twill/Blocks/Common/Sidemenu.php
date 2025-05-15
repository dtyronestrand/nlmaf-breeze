<?php

namespace App\View\Components\Twill\Blocks\Common;


use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\InlineRepeater;
use A17\Twill\Services\Forms\Fields\Checkbox;
use Symfony\Component\Yaml\Inline;

class Sidemenu extends Base
{


    public function getForm(): Form
    {
        return Form::make([
            InlineRepeater::make()->name('items')
            ->triggerText(__('Add item'))
            ->label(__('Menu Items'))
        ->fields([
            Input::make()->name('label')
            ->label(__('Label')),
            Input::make()->name('link')
            ->label(__('Link')),
        ]),
        Checkbox::make()->name('submenu')
        ->label(__('Has Submenu'))
        ->default(false),
        InlineRepeater::make()->name('subitems')
        ->triggerText(__('Add Subitem'))
        ->label(__('Submenu Items'))
        ->fields([
            Input::make()->name('label')
            ->label(__('Label')),
            Input::make()->name('link')
            ->label(__('Link')),
        ])->connectedTo('submenu', true),
        ]);
    }
    
    public static function getBlockTitle(): string
    {
        return __('Sidemenu');
    }
    public static function getBlockIcon(): string
    {
        return 'menu';
    }
}