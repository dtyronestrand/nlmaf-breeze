<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Form;
use App\Http\Controllers\Twill\Base\ModuleController as BaseModuleController;

class ProfileController extends BaseModuleController
{
    protected $moduleName = 'profiles';
    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected $titleColumnKey = 'name';

    protected $indexOptions = [
        'create' => false,
        'delete' => false,
    ];
    protected function setUpController(): void
    {
    }

    /**
     * See the table builder docs for more information. If you remove this method you can use the blade files.
     * When using twill:module:make you can specify --bladeForm to use a blade form instead.
     */
    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);
        $form->add(
            Input::make()->name('first_name')->label('First Name')->required(),
            Input::make()->name('last_name')->label('Last Name')->required(),
            Input::make()->name('email')->label('Email')->required(),
            Input::make()->name('phone')->label('Phone'),
            Input::make()->name('address')->label('Address'),
            Input::make()->name('city')->label('City'),
            Input::make()->name('state')->label('State'),
            Input::make()->name('zip')->label('Zip Code')
        );
        
 

        return $form;
    }

    /**
     * This is an example and can be removed if no modifications are needed to the table.
     */
    protected function additionalIndexTableColumns(): TableColumns
    {
        $table = parent::additionalIndexTableColumns();

        $table->add(
            Text::make()->field('description')->title('Description')
        );

        return $table;
    }
}
