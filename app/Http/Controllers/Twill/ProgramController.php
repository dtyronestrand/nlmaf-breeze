<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Forms\Fields\BlockEditor;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Http\Controllers\Admin\NestedModuleController as BaseModuleController;
use A17\Twill\Models\Base;


class ProgramController extends BaseModuleController
{
    protected $moduleName = 'programs';
    protected $showOnlyParentItemsInBrowsers = true;
    protected $nestedItemsDepth = 1;
    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
        $this->enableReorder();
        $this->setPermalinkBase('programs');
        $this->withoutLanguageInPermalink();
    }
    protected function form(?int $id, ?TwillModelContract $item = null): array
    {
        $data = parent::form($id, $item);

        $data['baseUrl'] = $data['baseUrl'] . $data['item']->ancestorsSlug . '/';

        return $data;
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
        );

        return $form;
    }
      /**
     * @param Model $item
     * @return array
     */
    protected function previewData($item)
    {
        $item->computedBlocks();
        return $this->previewForInertia($item->only($item->publicAttributes), [
            'page'=>'Page',
        ]);
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
