<?php

namespace App\View\Components\Twill\Blocks\Common;

use A17\Twill\Services\Forms\Fields\Wysiwyg;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\View\Components\Blocks\TwillBlockComponent;
use Illuminate\Contracts\View\View;
use A17\Twill\Services\Forms\Fields\Select;
use A17\Twill\Services\Forms\Options;
use A17\Twill\Services\Forms\Option;
use A17\Twill\Services\Forms\InlineRepeater;
use A17\Twill\Services\Forms\Fields\Medias;

class Cardblock extends Base
{


    public function getForm(): Form
    {
        return Form::make([
            Input::make()
            ->name('heading'),
            Select::make()
            ->name('type')
            ->options([
                Options::make([
                Option::make('standard', 'Standard'),
                Option::make('outlined', 'Outlined'),
                Option::make('flip', 'Flip'),
                ])
            ]),
            InlineRepeater::make()
            ->name('cards')
            ->fields([
                Input::make()->name('heading'),
                Input::make()->name('details'),
                Medias::make()->name('image')->max(1)
            ])
        ]);
    }
public static function getBlockTitle(): string
{
    return __('Card Block');
}
public static function getBlockIcon(): string
{
    return 'wysiwyg_card';
}
public static function getCrops(): array
{
    return [
        'image'=>[
            'default'=>[
                [
                    'name' => 'default',
                    'ratio'=>'free'
                ],

            ],
        ],
    ];
}
}

