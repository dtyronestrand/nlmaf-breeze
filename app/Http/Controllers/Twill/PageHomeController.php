<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;

use A17\Twill\Services\Forms\Fields\BlockEditor;
use A17\Twill\Services\Forms\Fieldset;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Form;
use App\Http\Controllers\Twill\Base\SingletonModuleController as BaseModuleController;
use App\Models\Base\Model; 
class PageHomeController extends BaseModuleController
{
    protected $moduleName = 'pageHomes';
    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
        $this->disablePermalink();
        $this->disableCreate();
        $this->disableDelete();
        $this->disablePublish();
        $this->disableEditor();
    }
protected function formData($request)
{
    return [
        'customPermalink'=>route('home'),
    ];
}
    /**
     * See the table builder docs for more information. If you remove this method you can use the blade files.
     * When using twill:module:make you can specify --bladeForm to use a blade form instead.
     */
    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);

        $form->add(
            BlockEditor::make()
                ->withoutSeparator()
                ->blocks([
                    'common-hero',
                    'common-heading',
                
                ])
            
        );

        return $form;
    }
    public function getSideFieldsets(TwillModelContract $model): Form
    {
        $form = parent::getSideFieldsets($model);

        $form->addFieldset(
            Fieldset::make()
                ->title('SEO')
                ->id('seo')
                ->fields([
                    Input::make()
                        ->name('meta_title')
                        ->label('Title')
                        ->translatable()
                        ->maxLength(100),

                    Input::make()
                        ->name('meta_description')
                        ->label('Description')
                        ->translatable()
                        ->maxLength(200),
                ])
        );

        return $form;
    }

    protected function previewData($item)
    {
        return $this->previewForInertia($item->only($item->publicAttributes), [
            'page' => 'Home',
        ]);
    }
    
    /**
     * This is an example and can be removed if no modifications are needed to the table.
     */
}